<?php if (have_rows('nav-items')): ?>
	<section class="secondary_navigation_bar pad-section secondary-nav" id="secondaryNavBar">
			<div id="selected-item"></div>
			<ul id="secondary-nav-items" class="sec_nav_bar_wrapper">
			<?php while(have_rows('nav-items')) : the_row();  ?>
					<?php
						$is_cta = false;
						$title = get_sub_field('title');
						$target = get_sub_field('target_address');
						
						if (get_sub_field('cta')): //print_r(get_sub_field('cta'));
							$is_cta = true;
							$url = get_sub_field('cta')['url'];
							$title = (get_sub_field('cta')['title']) ? get_sub_field('cta')['title'] : $title;
							$target = get_sub_field('cta')['target'];
						endif;
					?>
					
					<?php if ($title) { ?>
						<?php if($is_cta): ?>
							<li><a href="<?php echo $url; ?>" class="button cta" target="<?php echo $target ?>"><?php echo $title ?></a></li>
						<?php else: ?>
							<li><a href="javascript:void(0)" class="scroll_nav_item" data-target="<?php echo $target ?>"><?php echo $title ?></a></li>
						<?php endif; ?>
					<?php } ?>

			<?php endwhile; ?>
		</ul>
		<a id="nav-show-hide" href="javascript:void(0);" class="icon" onclick="navshowhide()">
  			<i id="nav-arrow" class="fas fa-angle-up"></i>
 		 </a>
	</section>
<?php endif; ?>
<script type="text/javascript">
//var activeitem = document.querySelector('ul#myLinks li.active').textContent;
//console.log(activeitem);
function navshowhide() {
  var x = document.getElementById("secondary-nav-items");
  if (x.style.display === "block") {
	var element = document.getElementById("nav-arrow");
	element.classList.add("fa-angle-up");
    x.style.display = "none";
  } else {
    x.style.display = "block";
	var element = document.getElementById("nav-arrow");
	element.classList.add("fa-angle-down");
  }
}

/*$('ul#secondary-nav-items li').on('click', function(e) {
      // alert($(this).text());
	  var si = $(this).text();
	   $('#selected-item').text(si);
       e.stopPropagation();
   });*/

/** scroll-down to target element on Nav-Item click **/
$(".scroll_nav_item").click(function() {
	let target = $(this).data('target');
	let topHeaderHeight = $(".sticky-container > .sticky").outerHeight();
	let secondaryHeaderHeight = $("#secondaryNavBar").outerHeight();
	console.log('clicktarget'+target);
	$('#selected-item').text(target);
	if($("."+target).length){
		let totalOffset=0
		
		//$("."+target).offset().top - this changes depending on whether the nav is sticky or not.
		// + 28 is for some extra padding

		if ($("#secondaryNavBar").hasClass('secBarSticky')) {
			totalOffset = ($("."+target).offset().top - (secondaryHeaderHeight + topHeaderHeight));
		} else {
			totalOffset = ($("."+target).offset().top - (secondaryHeaderHeight + topHeaderHeight + secondaryHeaderHeight + 28));
		}		
		
		$([document.documentElement, document.body]).animate({scrollTop: totalOffset+'px'}, 1500);
	
	}
});

$(document).ready(function(){
	var oldPadding = $('#secondaryNavBar').next().next().css("padding-top");
	var topMenu = $(".sec_nav_bar_wrapper"), 
	 // All nav-bar items
    menuItems = topMenu.find("a.scroll_nav_item"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
      //var item = $($(this).attr("href"));
	  let menuItemSel = $(this).data("target");
      let item = $('.'+menuItemSel);
      if (item.length) { return item; }
    });
	//console.log(scrollItems);
	
	// When the user scrolls the page, execute stickMyBar
	window.onscroll = function() { stickMyBar() };

	// Get the navbar
	var navbar = document.getElementById("secondaryNavBar");

	// Get the offset position of the navbar
	var sticky = navbar.offsetTop;
	
	
	// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
	function stickMyBar() {
		let topHeaderHeight = $(".sticky-container > .sticky").outerHeight();
		let secondaryHeaderHeight = $("#secondaryNavBar").outerHeight();
		let footerBannerOffset = $('.footer').offset().top;
		let windowTop = $(window).scrollTop();
		//console.log(windowTop+' : windowTop');
		//console.log(footerBannerOffset+' : footerBannerOffset');
		
		 // Get object of current scrolled item
	   let cur = scrollItems.map(function(){
		 if ($(this).offset().top < windowTop + topHeaderHeight  + secondaryHeaderHeight + 28)
		   return this;
	   });
	   
	   // Get current element
	   cur = cur[cur.length-1];
	   
	   let itarget = cur && cur.length==1 ? cur.attr('class') : "";
	  
	   // Set/remove active class
	   if(itarget == ""){
		menuItems
		 .parent().removeClass("active")
		 .end();
	     $('#selected-item').text('Introduction');
	   }else{
		menuItems
		 .parent().removeClass("active")
		 .end().filter("a[data-target='"+itarget+"']").parent().addClass("active");
		 var secnavheader = itarget.replace('-', " ");
		$('#selected-item').text(secnavheader).css('textTransform', 'capitalize');
	   }
		
	    //Add/Remove sticky class from Nav-bar
		if (windowTop + topHeaderHeight > footerBannerOffset) {
			navbar.classList.remove("secBarSticky");
			$('#secondaryNavBar').css('top',0);
			$('#secondaryNavBar').next().next().css('padding-top',oldPadding);
		} else if (window.pageYOffset - 28 > sticky) {
				navbar.classList.add("secBarSticky");
				$('#secondaryNavBar').css('top',topHeaderHeight);
				let stickyHeight = topHeaderHeight + secondaryHeaderHeight - 28;
				
				$('#secondaryNavBar').next().next().css('padding-top',stickyHeight);
		} else {
			navbar.classList.remove("secBarSticky");
			$('#secondaryNavBar').css('top',0);
			$('#secondaryNavBar').next().next().css('padding-top',oldPadding);
		}
	}
});
</script>