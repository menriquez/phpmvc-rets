#phpmvc-rets

##PHP-based MVC code used to for RETS data access and real-estate search
by Mark Enriquez

A small real-world example of a MVC I designed and implemented myself to apply the popular design pattern to the various real estate site I developed while at my previous job.

The model dir holds the data abstraction classes that extend PDO.  I implemented a data class, then a query class that allows forward iteration of search results contained in the data subclass.

It all ends up working quite well in a pratical manner.
