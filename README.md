Team Monkey Divers
==================

Team Members
------------

* [Ben Nuttall](http://twitter.com/ben_nuttall)
* [Jack Palfrey](http://twitter.com/jackpalf)
* [Mike Lehan](http://twitter.com/M1ke)
* Tom Canter

Project
-------

Our take on the [IMDb](http://intechnicahackmcr.azurewebsites.net/Home/Outline) challenge, using open movie APIs to answer interesting questions by large data analysis.

Our aim was to use data gathered from around the web to answer that age old question: in any given film, how many actors _share the same birthday?!_

Our plan was to use a web front end along with a PHP back end, drawing from databases most likely built on NoSQL solutions to provide a quick set up and rapid query responses.

Provided IMDb data was difficult to come by due to web connection problems and poor schemas, so we wrote a Python scraper to get birthdays off the large pages (one for each day) provided by IMDb, importing this into a Mongo database and providing a query layer through PHP.

We found open data from freebase.org for film and actor tie ins, using Ruby to condense large files and align actors with films, finding problems again with key referencing in the data but eventually getting enough information from the provider to get a proper import. The problem proved to be then getting a working import into the existing Mongo database.

We planned to run the system on Amazon, and put a lot of work into setting up two flexible EC2 instances, one to respond to user requests and another to store the database. This also presented problems due to load balancing failures but these were overcome, leaving us with stable servers for the project.

A PHP back end was designed and written with full tests for all use cases and objects to carry out major functions. This was extnded with MongoDB functionality but again it proved hard to test as there seemed to be discrepancies between what the CLI gave access to and what PHP could search.

In the end we nearly had an interesting data analysis product, but fell just short due to unforseen database issues and early difficulties getting the right data together.
