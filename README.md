"CSRF_Prevention-Synchronizer-Token-Patterns" 

Cross-Site Request Forgery protection in web applications via Synchronizer Token Patterns

Use my blogpost to get an understanding about this method!

https://medium.com/@hiruni/what-is-cross-site-request-forgery-csrf-662b0bc1e91c

You have to provide username as HDF and password as 123(hardcoded credentials). When a login is successful, a session will be created and the session id will be used to map with the CSRF token that will be generated along with the session creation.
Then the user redirects to a web page that allows the user to update a post. When this page loads with the help of AJAX, generated CSRF token value will be added to a hidden field in the HTML form.
Once the user updates a post CSRF token will be validated. If it is valid user will see the post he updated.
