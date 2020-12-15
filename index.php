<?php require_once 'function.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Division</title>
		<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		
		<style>
			table {
				margin: auto;
				width: auto;
			}
			td{
				text-align:center;
				width: 50px;
				height: 50px;
			}
			td input {
				width: 49px;
				height: 49px;
				padding: 0px;
				font-size: 120%;
				text-align:center;
				border-radius: 
			}
			td.hor {
				background-color: #000;
				height: 3px;
			}
			td.ver {
				background-color: #000;
				width: 4px;
			}
			td.moins {
				font-weight: bolder;
				font-size: 120%;
				width: 10px;
			}
			div.operation {
				margin: 0 auto;
				/* width: 500px; */
				border: 1px solid black;
			}
		</style>
	</head>
	<body>
		
		<div class="operation container-md">
			<?php
				if (isset($_POST['btn'])) {
					$n1 = random_int(100, 10000);
					$n2 = random_int(10, 100);
					echo division($n1, $n2);
				}
				else {
					echo division(2020, 2);
				}
			?>
		</div>
		
		<script>
			$(document).ready(function(){
				$('td input[type=text]').attr('maxlength', '1');
				$('#id1').focus();
				$("input.case").keyup(function(e){
					var i = $(this).attr("id");
					i = parseInt(i.replace("id", ""));
					if ($('#id'+i).val() >= 0 && $('#id'+i).val() <= 9 && $('#id'+i).val() != '' && e.which != 32) {
						if(i== ($('input.case').length)) $('input.case').blur();
						else { $('#id'+(i+1)).focus(); }
					}
				});
				$('#solution').click(function() {
					for (var i = 0; i < $('input.case').length; i++) {
						if ($('input.case').eq(i).val() === $('input.case').next().eq(i).val()) {
							$('input.case').eq(i).attr({'disabled':'','readonly':''});
							$('input.case').eq(i).css('background-color','#0be881')
						}
						else {
							$('input.case').eq(i).val('!').css('background-color','#ff3f34');
						}
					}
				});
				$('input.case').focus(function() {
					$(this).val('').css('background-color','#FFF');
				});
				// $("input.case:empty").val("...").css('background','#eeff11');
				$('#solution').dblclick(function() {
					for (var i = 0; i < $('input.case').length; i++) {
						$('input.case').eq(i).val($('input.case').next().eq(i).val());
					}
				});
			});
		</script>
	</body>
</html>