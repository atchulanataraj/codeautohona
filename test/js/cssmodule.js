	var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				showRight = document.getElementById( 'showRighte' ),
				menuTop = document.getElementById( 'cbp-spmenu-s3' ),
				showTop = document.getElementById( 'showTop' ),
				menuBottom = document.getElementById( 'cbp-spmenu-s4' ),
				showBottom = document.getElementById( 'showBottom' ),
				body = document.body;

			showRight.onClick = function() {
				//classie.toggle( this, 'active' );
			//	classie.toggle( menuRight, 'cbp-spmenu-open' );
				//classie.addClass( menuRight, 'cbp-spmenu-open' );
				$('#cbp-spmenu-s2').removeClass('.cbp-spmenu-open');
				
			};
			showTop.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuTop, 'cbp-spmenu-open' );
				
			};
			showBottom.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuBottom, 'cbp-spmenu-open' );
				disableOther( 'showBottom' );
			};
			function headerDown()
			{
				classie.toggle( showTop, 'active' );
				classie.toggle( menuTop, 'cbp-spmenu-open' );
			}
			function bottomUp()
			{
			 
				classie.toggle( showBottom, 'active' );
				classie.toggle( menuBottom, 'cbp-spmenu-open' );
			}
			function rightopen()
			{
				//classie.toggle( showRight, 'active' );
				//classie.toggle( menuRight, 'cbp-spmenu-open' );
					$('#showRighte').addClass('active');
					$('#cbp-spmenu-s2').addClass('cbp-spmenu-open');
					$('#cbp-spmenu-s2').show();		
			}
			function closeright()
			{
			$('#cbp-spmenu-s2').hide();
			}