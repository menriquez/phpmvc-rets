#phpmvc-rets

##PHP-based MVC code used to for RETS data access and real-estate search
by Mark Enriquez

A small real-world example of a MVC I designed and implemented myself to apply the popular design pattern to the various real estate site I developed while at my previous job.

The model dir holds the data abstraction classes that extend PDO.  I implemented a data class, then a query class that allows forward iteration of search results contained in the data subclass.

The controller dir holds the main controller for the business logic and to route data to views, and a SEO controller that talks to the models to get database into for SEO info.  I discoverd that creating a seperate controller for SEO allowed much more flexablity.

The view dir of course creates the views, but also uses loop views that allow data that needs to be displayed on a loop (like any listings and such) to be located in one place outside the main view.  This allows for easy maintainability.

It all ends up working quite well in a pratical manner...although I understand there is lots of room for improvement.
