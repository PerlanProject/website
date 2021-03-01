import pandas as pd
import numpy as np
from scipy.interpolate import interp1d
from matplotlib import pyplot as plt
import datetime
import math
import re
import os
import tqdm


class Data():
    def __init__(self, filename):
        self.filename = filename
        self.read()

    def select_interval(self, mi, ma):
        self.data = self.data[(self.data.time < ma) *
            ( self.data.time > mi ) ]

def extract_rcdata(filename):
    line_regex = re.compile(r"^\$[GLtPV][PXhN][RWeFIARD](?!B)")

    # Output file, where the matched loglines will be copied to
    output_filename = os.path.normpath(filename[:-4] + "_pro.dat")
        # Overwrites the file, ensure we're starting out with a blank file
    with open(output_filename, "w") as out_file:
            out_file.write("")


    # Open output file in 'append' mode
    with open(output_filename, "a") as out_file:
        #Read string into in-file and ignore utf-8 errors as these lines are irrelevant
        in_file =  open(filename, "rb").read().decode('utf-8', errors='ignore')
        # Loop over each log line
        for line in in_file.split('\n'):
            if (line_regex.search(line)):
                out_file.write(line)
    out_file.close()
    return output_filename


class TempData(Data):
    def read(self):
        self.data = pd.read_csv(self.filename, 'r',delimiter = ',',
            header = None)
        time = [float(self.data[1][i][:2])*3600. +\
               float(self.data[1][i][3:5])*60. +\
               float(self.data[1][i][6:8])
               for i in range(len(self.data[1])) ]
        self.data.columns =['UNR_UTC_RTC_Date','UNR_UTC_RTC_Time',
            'UNR_UTC_GPS_Date','UNR_UTC_GPS_Time',
            'UNR_ThermistorTemp_C','UNR_ADSgain',
            'UNR_ThermistorSens_mV','UNR_numberAverages','UNR_VO_mV',
            'UNR_ThermistorResistance_Ohms','UNR_sht_Temperature_C',
            'UNR_sht_RH_%','UNR_shtDewTemp_C','UNR_lat','UNR_lon',
            'UNR_alt','UNR_Speed_kph','UNR_Course_degrees',
            'UNR_RawTMP36_mvolts','UNR_RawUVa_mvolts',
            'UNR_RawUVb_mvolts','UNR_UVboardTemp_C',
            'UNR_UVa_uWpercm2','UNR_UVb_uWpercm2']
        self.data.insert(0, 'time', time)
        print('UNR data processed!')

class ADPData(Data):
    def read(self):
        self.raw = pd.read_csv(self.filename, 'r', delimiter = ',',
                dtype={'GPS Time [HHMMSS.SSS GMT]': 'str'},
                error_bad_lines = False)
        self.time = [ 18. + float(x[:2])*3600. + float(x[2:4])*60.
                 +float(x[4:]) for x in
                self.raw['GPS Time [HHMMSS.SSS GMT]'] ]
        self.dp_13 = np.array( np.array(((self.raw['P1_Alpha [RAW]'] -
            1638. )*80 / 13107 ) - 40) )
        self.dp_24 = np.array(((self.raw['P2_Beta [RAW]'] -
            1638. )*80. / 13107. ) - 40.)
        self.q = np.array((self.raw['P3_q [RAW]'] - 1638.
            )*120. / 13107.  - 60.) * 100.
        self.ps = np.array((self.raw['P4_Static [RAW]'] - 1638.
            )*1.6 / 13170. ) *100000.
        self.alpha = 25.3 * np.arctan( self.dp_13 / self.q*100. )
        self.beta = -25.3 * np.arctan( self.dp_24 / self.q*100. )

        self.data = pd.DataFrame( { 'time': self.time, 'dp_13':self.dp_13,
            'dp_24':self.dp_24, 'q':self.q, 'ps':self.ps, 'alpha':self.alpha,
            'beta':self.beta })
        print("ADP Logfile processed!")

    def fixtime(self):
        #make array with system time stamps when there was a gps fix
        eq1 = self.raw[self.raw['Fix [1:0]'].eq(1)]['Elapsed Time [ms]']
        #make array with system time stamps when there was no gps fix
        eq0 = np.array(self.raw[self.raw['Fix [1:0]'].eq(0)
            ]['Elapsed Time [ms]'])
        print('Finding closest GPS fixes...')
        args = [ find_nearest(eq1.values, v) for v in eq0 ]
        print('Fixes found')
        #indices of missing gps fixes
        idx = self.raw.index[self.raw['Fix [1:0]'].eq(0)]
        #gps times available
        gps = self.raw[self.raw['Fix [1:0]'].eq(1)
            ]["GPS Time [HHMMSS.SSS GMT]"].values
        gps1 = [self.time[i] for i in
            self.raw.index[self.raw['Fix [1:0]'].eq(1)] ]
        st1 = np.array([ eq1.values[args[i]] for i in range(len(args)) ])
        for i in range(len(idx)):
            self.time[idx[i]] = 0.001*(eq0[i]-st1[i]) + self.time[args[i]]
        print('GPS interpolation done')
        for i in range(len(self.time)-1):
            if self.time[i+1] < self.time[i]:
                self.time[i+1] = self.time[i] + \
                (self.raw['Elapsed Time [ms]'].values[i+1] -
                self.raw['Elapsed Time [ms]'].values[i])*0.001
        self.data = pd.DataFrame( { 'time': self.time, 'dp_13':self.dp_13,
            'dp_24':self.dp_24, 'q':self.q, 'ps':self.ps, 'alpha':self.alpha,
            'beta':self.beta })
        print('Done')

def find_nearest(array,value):
     idx = np.searchsorted(array, value, side="left")
     if idx > 0 and (idx == len(array) or math.fabs(value -
        array[idx-1]) < math.fabs(value - array[idx])):
         return idx-1
     else:
         return idx



def conc_flightdata(adp, imu, temp = None, qthresh = 0.5):

    if temp:
        c = pd.concat( [adp.data, imu.data, temp.data],
            ignore_index = True, sort = False)
    else:
        c = pd.concat( [adp.data, imu.data],
		ignore_index = True, sort = False)
    c['time'] = pd.to_numeric(c['time'],
			errors = 'coerce')
    c = c.sort_values('time')
    c = c.reset_index(drop=True)
#    c = c[(c.time < np.max(c[c.q>qthresh].time)) *
#            ( c.time > np.min(c[c.q>qthresh  ].time )) ]
    print('Done')
    return c


def extract_time( data, tmin, tmax):
    return data[( data.time < tmax) * (data.time > tmin) ]


def strpnan(d1,d2):
    return d1[d2.notnull()], d2[d2.notnull() ]



class RCData(Data):
    def read(self):
        pos = []
        alt = []
        temp = []
        imu = []
        ins = []
        adp = []
        marks = []
        controls = []
        ctemp = 0
        ctime = 0
		#gets rid of non-flighr relevant and binary data
        self.fdata_file = extract_rcdata(self.filename)
        print("Flight data extracted")
        rdata = open(self.fdata_file, 'r')
        self.lines = [ line.strip().split(',') for line in rdata.readlines() ]
        time = "NaN"
		#sorts lines into temporary arrays according to their NMEA message
		#type
        for i in tqdm.tqdm(range(len(self.lines))):
            line = self.lines[i]
			# LX9000 GPS (Solaris) position message
            if re.match('\$GPRMC', line[0]):
                try:
                    time = float(line[1][:2])*3600. + float(line[1][2:4])*60. +\
                        float(line[1][4:])
                    lat = float(line[3][:2]) + float(line[3][2:4])/60. +\
                        float(line[3][4:])/60.
                    if line[4] == 'S':
                        lat = -lat
                    lon = (float(line[5][:3]) + float(line[5][3:5])/60. +\
                        float(line[5][4:])/60. )
                    if line[6] == 'W':
                        lon = -lon
                    ctime = ctime +1
                    pos.append([time, lat, lon])
                except:
                    print('line corrupted: ', i)
			# LX9000 altitude message
            elif re.match('\$LXWP0', line[0]):
                try:
                    alt.append([time, float(line[3]) ])
                except:
                    print('line corrupted: ',i)
			#Outside air temperature by UNR instrumentation
            elif re.match('\$therm', line[0]):
                try:
                    ctemp = ctemp +1
                    temp.append([time ,float(line[1])])
                except:
                    print('line corrupted (LXWP): ', i)
            #VectorNav VN-300 IMU attitue message
            elif re.match('\$PPFD', line[0]):
                try:
                    imu.append([
                        float(line[1])%(3600*24),
                        float(line[2]), float(line[3]), float(line[4]), float(line[5]),
                        float(line[6])*0.51444, float(line[7])*0.51444,
                        float(line[8]), float(line[9]), float(line[10]),
                        float(line[11]), float(line[12]),
                        line[13], float(line[14]), float(line[15][:-3]) ])
                except:
                    print('line corrupted (PPFD): ',i)
            #VectorNav event marker
            elif re.match('\$PPRK', line[0]):
                try:
                    marks.append([time, int(line[1][:-3])])
                except:
                    print('line corrupted (PPRK): ',i)
                    pass
            #control positions from Perlan magnetic sensors
            elif re.match('\$PPD', line[0]):
                try:
                    controls.append( [time, float(line[1]),
                       float(line[2]), float(line[3]),
                       float(line[4]), float(line[5][:-3]) ])
                except:
                    print('line corrupted (PPD): ',i)
        #name array array columns and generate pandas DataFrames
        self.pos = pd.DataFrame(pos, columns = ['time', 'lat', 'lon'] )
        self.temp = pd.DataFrame(temp, columns = ['time', 'UNR_temperature'])
        self.alt = pd.DataFrame(alt, columns = ['time', 'alt'])
        self.imu = pd.DataFrame(imu, columns = ['time', 'imu_pitch',
			'imu_roll', 'imu_yaw', 'imu_hdg','imu_ias','imu_tas',
			'imu_v_z', 'imu_te_var','imu_ne_var','imu_p_pitch',
			'imu_fp_yaw', 'imu_status', 'imu_aoa', 'imu_cl'])
        self.adp = pd.DataFrame(adp, columns = ['time', 'adp_ias_rc',
			'adp_alpha_rc', 'adp_beta_rc'])
        self.marks = pd.DataFrame(marks, columns = ['time',
			'imu_event_number'])
        self.controls =pd.DataFrame(controls, columns =['time',
			'aileron_left', 'aileron_right', 'elevator_left',
			'elevator_right','rudder'])
		#Concatenate all data into one data frame
        self.data = pd.concat([self.pos, self.temp, self.alt,
                    self.imu, self.adp,
			self.marks, self.controls], sort=False)
        #clean up time data and sort array according to time
        self.data['time'] = pd.to_numeric(self.data['time'],
			errors = 'coerce')
        self.data = self.data.sort_values('time')
        self.data = self.data.reset_index(drop=True)
        print('Rear Concentrator data processed!')

    def write_csv(self):
        self.data.to_csv(filename[:-4] + '_flightdata.csv')
        print(filename[:-4] + '_flightdata.csv written')




#####################################################

def float2(s):
    try:
        return float(s)
    except:
        return "NaN"


def extract_imudata(filename):
    line_regex = re.compile(r"^\$[GLtPV][PXhN][RWeFIARDPO](?!B)")
    # Output file, where the matched loglines will be copied to
    output_filename = os.path.normpath(filename[:-4] + "_pro.dat")
    # Overwrites the file, ensure we're starting out with a blank file
    with open(output_filename, "w") as out_file:
        out_file.write("")

    # Open output file in 'append' mode
    with open(output_filename, "a") as out_file:
    # Open input file in 'read' mode
        with open(filename, "r") as in_file:
            # Loop over each log line
            for line in in_file:
            # If log line matches our regex, print to console, and output file
                if (line_regex.search(line)):
                    out_file.write(line)
    in_file.close()
    out_file.close()
    return output_filename


class IMUData(Data):

    def read(self):
        pos = []
        alt = []
        temp = []
        ozn = []
        ppff = []
        ppfd  = []
        ins = []
        vnisl = []
        vnins = []
        adp = []
        marks = []
        controls = []
        ctemp = 0
        ctime = 0
	#gets rid of non-flighr relevant and binary data
        self.fdata_file = extract_imudata(self.filename)
        print("IMU data extracted")
        rdata = open(self.fdata_file, 'r')
        self.lines = [ line.strip().split(',') for line in rdata.readlines() ]
        cnt  = 0
        time = "NaN"
		#sorts lines into temporary arrays according to their NMEA message
		#type
        for i in tqdm.tqdm(range(len(self.lines))):
            line = self.lines[i]
			# LX9000 GPS (Solaris) position message
            if re.match('\$GPRMC', line[0]):
                try:
                    time = float(line[1][:2])*3600. + float(line[1][2:4])*60. +\
                         float(line[1][4:])
                    lat = float(line[3][:2]) + float(line[3][2:4])/60. +\
                         float(line[3][4:])/60.
                    if line[4] == 'S':
                        lat = -lat
                    lon = (float(line[5][:3]) + float(line[5][3:5])/60. +\
                            float(line[5][4:])/60. )
                    if line[6] == 'W':
                        lon = -lon
                    ctime = ctime +1
                    pos.append([time, lat, lon])
                except:
                    print('line corrupted (GPRMC): ', i)
			# LX9000 altitude message
            elif re.match('\$LXWP0', line[0]):
                try:
                    alt.append([time, float(line[3]) ])
                except:
                    print('line corrupted (LXWP0): ',i)
			#Outside air temperature by UNR instrumentation
            elif re.match('\$therm', line[0]):
                try:
                    temp.append([time ,float(line[1]), float(line[2]), float(line[3])])
                except:
                    print('line corrupted (therm): ', i)
            elif re.match('\$PPOZN', line[0]):
                try:
                    ozn.append([time ,float(line[1][:-3])])
                except:
                    print('line corrupted (PPOZN): ', i)
            elif re.match('\$PPADP', line[0]):
                try:
                    adp.append([time ,float(line[1]), float(line[2]),
                    float(line[3]), float(line[4][:-3])])
                except:
                    print('line corrupted (ADP): ', i)
            #VectorNav VN-300 IMU attitue message
            elif re.match('\$PPFD', line[0]):
                try:
                    time = float(line[1])%(3600*24)
                    ppfd.append([
                        float(line[1])%(3600*24),
                        -float(line[2]), float(line[3]),float(line[4]), float(line[5]),
                        float(line[6])*0.51444, float(line[7])*0.51444,
                        float(line[8]), float(line[9]), float(line[10]),
                        float(line[11]), float(line[12]),
                        line[13], float(line[14]), float(line[15][:-3]) ])
                except:
                    print('line corrupted (PPFD): ',i)
            #VectorNav event marker
            elif re.match('\$PPRK', line[0]):
                try:
                    marks.append([time, int(line[1][:-3])])
                except:
#    		        print('line corrupted (PPRK): ',i)
                    pass
            #control positions from Perlan magnetic sensors
            elif re.match('\$PPD', line[0]):
                try:
                    controls.append( [time, float(line[1]),
                       float(line[2]), float(line[3]),
                       float(line[4]), float(line[5][:-3]) ])
                except:
                    print('line corrupted (PPD): ',i)
            #control stick deflection and forces
            elif re.match('\$PPFF', line[0]):
                try:
                    time = float(line[1])%(3600*24)
                    ppff.append([
                        float(line[1])%(3600*24),
                        float2(line[2]), float2(line[3]), float2(line[4]), float2(line[5]),
                        float2(line[6]), float2(line[7][:-3]) ])
                except:
                    print('line corrupted (PPFF): ',i)
            #VNISL message from VN300 (INS state)
            elif re.match('\$VNISL', line[0]):
                try:
                    #line for are padding bytes
                    vnisl.append([time, float(line[1]), float(line[2]),
                        float(line[3]),float(line[4]), float(line[5]),
                        float(line[6]), float(line[7]),float(line[8]),
                        float(line[9]), float(line[10]), float(line[11]),
                        float(line[12]), float(line[13]), float(line[14]),
                        float(line[15][:-3]) ])
                except:
                    print('line corrupted (VNISL): ',i)
            #VNINS message from VN300 (INS state)
            elif re.match('\$VNINS', line[0]):
                try:
                    time = float(line[1])%(3600*24)
                    #line for are padding bytes
                    vnins.append([time, float(line[2]),
                        line[3],float(line[4]), float(line[5]),
                        float(line[6]), float(line[7]),float(line[8]),
                        float(line[9]), float(line[10]), float(line[11]),
                        float(line[12]), float(line[13]), float(line[14]),
                        float(line[15][:-3]) ])
                except:
                    print('line corrupted (VNINS): ',i)


        #name array array columns and generate pandas DataFrames
        self.pos = pd.DataFrame(pos, columns = ['time', 'lx_lat', 'lx_lon'] )
        self.ozn = pd.DataFrame(ozn, columns = ['time', 'o3'] )
        self.temp = pd.DataFrame(temp, columns = ['time', 'UNR_temperature', 'UNR_UVA', 'UNR_UVB'])
        self.alt = pd.DataFrame(alt, columns = ['time', 'lx_alt'])
        self.ppfd = pd.DataFrame(ppfd, columns = ['time', 'imu_pitch_ppfd',
			'imu_roll', 'imu_yaw_ppfd', 'imu_hdg','imu_ias','imu_tas',
			'imu_v_z', 'imu_te_var','imu_ne_var','imu_p_pitch',
			'imu_fp_yaw', 'imu_status', 'imu_aoa', 'imu_cl'])
        self.ppff = pd.DataFrame(ppff, columns = ["time", 'roll_defl',
            'pitch_defl', 'yaw_defl', 'airbrake_defl', 'aileron_fc', 'elevator_fc'])
        self.vnisl = pd.DataFrame( vnisl, columns = ['time','imu_yaw', 'imu_pitch',
            'imu_roll', 'imu_lat', 'imu_long', 'imu_alt', 'imu_vx', 'imu_vy',
            'imu_vz','imu_ax', 'imu_ay','imu_az', 'imu_angrate_x',
            'imu_angrate_y','imu_angrate_z' ])
        self.vnins = pd.DataFrame( vnins, columns = ['time',
            'imu_week',
            'imu_status', 'imu_yaw', 'imu_pitch', 'imu_roll', 'imu_lat',
            'imu_lon', 'imu_alt', 'imu_vx_n', 'imu_vy_e', 'imu_vz_d',
            'imu_d_att', 'imu_d_pos', 'imu_d_v'] )
        self.adp = pd.DataFrame(adp, columns = ['time','ADP_time','adp_ias_rc',
			'adp_alpha_rc', 'adp_beta_rc'])
        self.marks = pd.DataFrame(marks, columns = ['time',
			'imu_event_number'])
        self.controls =pd.DataFrame(controls, columns =['time',
				'aileron_left', 'aileron_right',
                                'elevator_left','elevator_right','rudder'])


        #Concatenate all data into one data frame
        self.data = pd.concat([self.pos, self.temp, self.ozn, self.alt,
                    self.adp,
			self.marks, self.controls, self.vnins, self.vnisl,
                        self.ppff, self.ppfd], sort=False)
        #clean up time data and sort array according to time
        #self.data['time'] = pd.to_numeric(self.data['time'],
	#		errors = 'coerce')
        self.data = self.data.sort_values('time')
        self.data = self.data.reset_index(drop=True)
        print('VectorNav data processed!')

    def write_csv(self):
        self.data.to_csv(self.filename[:-4] + '_imudata.csv')
        print(self.filename[:-4] + '_imudata.csv written')




