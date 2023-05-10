<footer class="site-footer">
          <div class="text-center">
              <?php echo date('Y');?> - Sistem Kasir
          </div>
      </footer>
<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

	<script src="assets/datatables/jquery.dataTables.min.js"></script>
	<script src="assets/datatables/dataTables.bootstrap.min.js"></script>
  <!--common script for all pages-->
  <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
    </script>
		<script>
			$(".modal-create").hide();
			$(".bg-shadow").hide();
			$(".bg-shadow").hide();
			function clickModals(){
				$(".bg-shadow").fadeIn();
				$(".modal-create").fadeIn();
			}
			function cancelModals(){
				$('.modal-view').fadeIn();
				$(".modal-create").hide();
				$(".bg-shadow").hide();
			}
		</script>