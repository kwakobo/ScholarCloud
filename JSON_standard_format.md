# Standard format for JSON

## Example of 3 articles
~~~~
[
	{
		"title":"Web application modeling for testing and analysis",
		"authors":"William G. J. Halfond",
		"article":"http://dl.acm.org/ft_gateway.cfm?id=1496657",
		"bibtex":"http://dl.acm.org/exportformats.cfm?expformat=bibtex&id=1496657",
		"publication_type":"PDF",
		"abstract":"The goal of my work is to improve quality assurance techniques for web applications. I will develop automated techniques for modeling web applications and use these models to improve testing and analysis of web applications.",
		"conference":"the 2008 Foundations of Software Engineering Doctoral Symposium"
	},
	{
		"title":"Preventing SQL injection attacks using AMNESIA",
		"authors":"Alessandro Orso",
		"article":"http://dl.acm.org/ft_gateway.cfm?id=1134416",
		"bibtex":"http://dl.acm.org/exportformats.cfm?expformat=bibtex&id=1134416",
		"publication_type":"PDF",
		"abstract":"AMNESIA is a tool that detects and prevents SQL injection attacks by combining static analysis and runtime monitoring. Empirical evaluation has shown that AMNESIA is both effective and efficient against SQL injection.",
		"conference":"Proceeding of the 28th international conference"
	},
	{
		"title":"SIF",
		"authors":"Ramesh Govindan",
		"article":"http://dl.acm.org/ft_gateway.cfm?id=2465430",
		"bibtex":"http://dl.acm.org/exportformats.cfm?expformat=bibtex&id=2465430",
		"publication_type":"PDF",
		"abstract":"Mobile app ecosystems have experienced tremendous growth in the last five years. As researchers and developers turn their attention to understanding the ecosystem and its different apps, instrumentation of mobile apps is a much needed emerging capability. In this paper, we explore a selective instrumentation capability that allows users to express instrumentation specifications at a high level of abstraction; these specifications are then used to automatically insert instrumentation into binaries. The challenge in our work is to develop expressive abstractions for instrumentation that can also be implemented efficiently. Designed using requirements derived from recent research that has used instrumented apps, our selective instrumentation framework, SIF, contains abstractions that allow users to compactly express precisely which parts of the app need to be instrumented. It also contains a novel path inspection capability, and provides users feedback on the approximate overhead of the instrumentation specification. Using experiments on our SIF implementation for Android, we show that SIF can be used to compactly (in 20-30 lines of code in most cases) specify instrumentation tasks previously reported in the literature. SIF's overhead is under 2% in most cases, and its instrumentation overhead feedback is within 15% in many cases. As such, we expect that SIF can accelerate studies of the mobile app ecosystem.",
		"conference":"Proceeding of the 11th annual international conference"
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
		"article":"http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=7515472",
		"bibtex":"http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=7515472"
		"text":"Cross-LibraryAPIRecommendationusing Web Search EnginesWujie Zheng, Qirun Zhang, Michael LyuComputer Science and EngineeringThe Chinese University of Hong Kong, China{wjzheng,qrzhang,lyu}@cse.cuhk.edu.hkABSTRACTSoftware systems are often built upon third party libraries.Developers may replace an old library with a new library,for the consideration of functionality, performance, security,and so on.  It is tedious to learn the often complex APIsin the new library from the scratch.   Instead,  developersmay identify the suitable APIs in the old library, and thenfind counterparts of these APIs in the new library.  How-ever, there is typically no such cross-references for APIs indifferent libraries.   Previous work on automatic API rec-ommendation often recommends related APIs in the samelibrary.  In this paper, we propose to mine search results ofWeb search engines to recommend related APIs of differentlibraries. In particular, we use Web search engines to collectrelevant Web search results of a given API in the old library,and then recommend API candidates in the new library thatare frequently appeared in the Web search results. Prelimi-nary results of generating related C# APIs for the APIs inJDK show the feasibility of our approach.Categories and Subject DescriptorsD.2.7 [Software Engineering]: Distribution, Maintenance,and EnhancementGeneral TermsDocumentation, Reliability1.  INTRODUCTIONCode reuse is one of the primary techniques to improvethe productivity of building software systems.  Due to therequirement changes of a software system, developers mayneed to replace an old library with a new library.  Workingwith complex APIs in the new library presents many barri-ers, such as selecting the appropriate APIs and figuring outhow to use the selected APIs. Since the developers often canidentify the suitable APIs in the old library easily, a possiblesolution is to find counterparts of the old APIs in the new…"
	},
	…
]
~~~~
