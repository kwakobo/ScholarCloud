# Standard format for JSON

## Example of 3 articles
~~~~
[  
	{  
		"title":"Detecting and Localizing Internationalization Presentation Failures in Web Applications",
		"authors":"Abdulmajeed Alameer; Sonal Mahajan; William G. J. Halfond",
		"pdf":"http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=7515472",
		"bibtex":"http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=7515472"
	},
	{  
		"title":"An Empirical Study of Internationalization Failures in the Web",
		"authors":"Abdulmajeed Alameer; William G. J. Halfond",
		"pdf":"http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=7816457",
		"bibtex":"http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=7816457"
	},
	{  
		"title":"An Empirical Study of the Energy Consumption of Android Applications",
		"authors":"Ding Li; Shuai Hao; Jiaping Gui; William G. J. Halfond",
		"pdf":"http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=6976078",
		"bibtex":"http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=6976078"
	}
]
~~~~


## Example with article data
~~~~
[
	…
	{  
		"title":"Detecting and Localizing Internationalization Presentation Failures in Web Applications",
		"authors":"Abdulmajeed Alameer; Sonal Mahajan; William G. J. Halfond",
		"pdf":"http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=7515472",
		"bibtex":"http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=7515472"
		"text":"Cross-LibraryAPIRecommendationusing Web Search EnginesWujie Zheng, Qirun Zhang, Michael LyuComputer Science and EngineeringThe Chinese University of Hong Kong, China{wjzheng,qrzhang,lyu}@cse.cuhk.edu.hkABSTRACTSoftware systems are often built upon third party libraries.Developers may replace an old library with a new library,for the consideration of functionality, performance, security,and so on.  It is tedious to learn the often complex APIsin the new library from the scratch.   Instead,  developersmay identify the suitable APIs in the old library, and thenfind counterparts of these APIs in the new library.  How-ever, there is typically no such cross-references for APIs indifferent libraries.   Previous work on automatic API rec-ommendation often recommends related APIs in the samelibrary.  In this paper, we propose to mine search results ofWeb search engines to recommend related APIs of differentlibraries. In particular, we use Web search engines to collectrelevant Web search results of a given API in the old library,and then recommend API candidates in the new library thatare frequently appeared in the Web search results. Prelimi-nary results of generating related C# APIs for the APIs inJDK show the feasibility of our approach.Categories and Subject DescriptorsD.2.7 [Software Engineering]: Distribution, Maintenance,and EnhancementGeneral TermsDocumentation, Reliability1.  INTRODUCTIONCode reuse is one of the primary techniques to improvethe productivity of building software systems.  Due to therequirement changes of a software system, developers mayneed to replace an old library with a new library.  Workingwith complex APIs in the new library presents many barri-ers, such as selecting the appropriate APIs and figuring outhow to use the selected APIs. Since the developers often canidentify the suitable APIs in the old library easily, a possiblesolution is to find counterparts of the old APIs in the new…"
	},
	…
]
~~~~
