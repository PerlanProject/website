These are manually-dumped Pod Templates, which display a single Pod item, e.g., a Flight.  Pods uses its own DSL
to augment HTML and PHP (which is deprecated, but continues to work.  IMHO it's a mistake to deprecate, so
maybe the Pods people will reconsider).  

The DSL has "Template Tags" e.g., 
	- conditionals [if field]...[/if]
	- iteration [each item]
	- displaying info or after The Loop [before],[after]

Pods documentation is sparse and the server is sometimes accessible, but here's the pages:
- https://docs.pods.io/displaying-pods/template-tags/if-conditional-tag/
- https://docs.pods.io/displaying-pods/template-tags/example-template-tag-usage/
- https://docs.pods.io/displaying-pods/template-tags/before-and-after/
- https://docs.pods.io/displaying-pods/template-tags/each-loop-tag/

I think Pods Templates and their Template Tags are brilliant, and I decided to use them to 
make it simple for anyone to modify, rather than using PHP, as is normal WordPress for templates.

-- jdm
April 2021
