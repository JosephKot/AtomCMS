<?php
//JavaScript
?>	
		
<!-- jQuery CDN -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

<!-- jquery UI -->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<!-- TinyMCE --->
<script src="js/tinymce/tinymce.min.js"></script>

<!-- Dropzone -->
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<!-- <script src="js/dropzone.js"></script> -->

<script>
	$(document).ready(function(){
		$("#console-debug").hide();
		
		$("#btn-debug").click(function(){
			$("#console-debug").toggle();
		});
		
		$(".btn-delete").on("click", function() {
			
			var selected = $(this).attr("id");
			var pageid = selected.split("del_").join("");
			
			var confirmed = confirm("Are you sure that you want to delete this page?");
			
			if(confirmed == true) {
				$.get("ajax/pages.php?id="+pageid);
				$("#page_"+pageid).remove();
			}
			

			
			//alert(selected);
			
		})
		
		$("#sort-nav").sortable({
			cursor: "move",
			update: function() {
				var order = $(this).sortable("serialize");
				$.get("ajax/list-sort.php", order);
			}
			
		});

		$('.nav-form').submit(function(event) {

			var navData = $(this).serializeArray();
			var navLabel = $('input[name=label]').val();
			var navID = $('input[name=id]').val();

			$.ajax({

				url: "ajax/navigation.php",
				type: "POST",
				data: navData 

			}).done(function() {

				$("#label_"+navID).html(navLabel);

			});



			event.preventDefault();
		
		});
		
	}); // END document.ready();
	
  tinymce.init({
    selector: '.editor',
    theme: 'modern',
   // width: 600,
   // height: 300,
    plugins: [
      'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
  });

</script>