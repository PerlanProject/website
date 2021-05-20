import shutil, os

svn_root  = 'Controlled.svn/Systems/Data Network Logs/'
data_root = 'data/'
flights_root = data_root + 'Flights'
soundings_root = data_root + 'Soundings'


# returns immediate subdirectories of a given parent, i.e., one level deep
def get_subdirs(parent, names_starting_with=None, fullpath=True):
    for root, dirs, files in os.walk(parent): # walk() returns a generator

        if names_starting_with:
            filtered = []
            n = len(names_starting_with)
            for d in dirs:
                if d[:n] == names_starting_with:
                    filtered.append(d)
            dirs = filtered

        if fullpath:
            dirs = [f"{parent}/{dir}" for dir in dirs]
        return dirs # NOTE: we're deliberately returning out of the for loop, executing os.walk() just once

# returns immediate files in a given parent, i.e., one level deep
def get_files(parent, names_starting_with=None, suffix=None, fullpath=True):
    for root, dirs, files in os.walk(parent):
        
        if names_starting_with or suffix:
            filtered = []
            if names_starting_with:
                n = len(names_starting_with)
                for f in files:
                    if f[:n].lower() == names_starting_with.lower():
                        filtered.append(f)
                files = filtered
            if suffix:
                n = len(suffix)
                for f in files:
                    if f[-n:].lower() == suffix.lower():
                        filtered.append(f)
                files = filtered

        if fullpath:
            files = [f"{parent}/{file}" for file in files]

        return files # NOTE: we're deliberately returning out of the for loop, executing os.walk() just once

def only_names_starting_with(array, string=None):
    if string is None:
        return array
    filtered = []
    n = len(string)
    for f in array:
        if f[:n].lower() == string.lower():
            filtered.append(f)         
    return filtered

def only_names_ending_with(array, string=None):
    if string is None:
        return array
    filtered = []
    n = len(string)
    for f in array:
        if f[-n:].lower() == string.lower():
            filtered.append(f)         
    return filtered
            
# depth-first traversal of 'root' 
def get_children(parent, kind="dirs", names_starting_with=None, names_ending_with=None, depth=1):
    for root, dirs, files in os.walk(parent):

        filtered = dirs if kind == "dirs" else files   
        filtered = only_names_starting_with(filtered, string=names_starting_with)
        filtered = only_names_ending_with(filtered, string=names_ending_with)

        if dirs and (depth > 1): # depth-first search
            for d in dirs:
                if d is None:
                    continue
                results = get_children(f"{root}/{d}", 
                                       kind=kind, 
                                       names_starting_with=names_starting_with, 
                                       names_ending_with=names_ending_with, 
                                       depth=depth-1)
                if results:
                    filtered.extend([f"{d}/{item}" for item in results])

        return filtered


# Create the bare dirs for each Flight in the data dir.  Only needs run once
def make_Flights_dirs(parent):
    os.chdir(parent)

    for i in range(65):
        dname = f"{i+1:04}"
        if os.path.exists(dname): 
            continue
        print(f"mkdir {dname}")
        os.mkdir(dname)


# returns a dict of flight number to directory name, e.g., {'0053': 'Flt53 10 Sept 2018'}
def get_svn_flight_dirs(parent):
    svn_flights = {}

    for i in os.scandir(parent):
        if i.is_dir():
            dirname = i.name
            if dirname[:3] == 'Flt':
                shortname = dirname.split()[0]
                if len(shortname) < 4:
                    continue
                flight = shortname[3:]
                flight = f"{int(flight):04}"
                
                svn_flights[flight] = dirname
                
    return svn_flights


# copy KML files, listed in the 'kmls' param, to the destination data/Flights/__
def copy_kmls(kmls):
    for d in kmls:
        i = d.find('/')
        svn_dir = d[:i]

        try:
            data_dir = svn_flights_reverse[svn_dir]
        except:
            continue

        src = f"{svn_root}/{d}"
        dst = f"{data_root}/{data_dir}/Flt{data_dir}.kml"
        shutil.copy(src, dst)
        

def get_svn_flight_dirs(parent):

    svn_flights = {}

    for i in os.scandir(parent):
        if i.is_dir():
            dirname = i.name
            if dirname[:3] == 'Flt':
                shortname = dirname.split()[0]
                if len(shortname) < 4:
                    continue
                flight = shortname[3:]
                flight = f"{int(flight):04}"
                
                svn_flights[flight] = dirname
                
    return svn_flights

