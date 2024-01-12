<br><br>
</div> 
  <!-- FOOTER -->
 <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <a target="_blank" href="http://helpuitservice.com/">Designed & Developed by helpuitservice.com</a>
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Students</a></li>
                        <li><a href="#">Courses</a></li>
                        <li><a href="#">Courses</a></li>
                        <li><a href="#">Download</a></li>
                        <li><a href="#">Media</a></li>
                        <li><a href="#">Contact</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
    
    <script type="text/javascript" src="themes/js/validate.js"></script>
    
      <script>
    $(document).ready(function(e) {
		 
		 
		
		
		$('ul ul.dropdown-menu').each(function() {
            $(this).closest('li').addClass("dropdown");
			
			$(this).closest('li').find('a:first').attr('data-toggle','dropdown');
        });
		
		$('ul ul ul.dropdown-menu').each(function() {
            $(this).closest('li').removeClass("dropdown").addClass("dropdown-submenu");
        });
		//$('.dropdown-submenu > a').submenupicker();
        $('form').validate();
    });
    </script>
    
</body>
</html>

 