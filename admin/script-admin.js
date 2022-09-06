const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function ()
 {
	if(this.checked)
	 {
		document.body.classList.add('dark');
	}
	 else
	  {
		document.body.classList.remove('dark');
	}
})

/* Table JS Start */

if (/(iPhone|iPad|iPod)/gi.test(navigator.userAgent) && window.location.pathname.indexOf('/full') > -1) {
  var p = document.createElement('p');
  p.innerHTML = '<a target="_blank" href="https://s.codepen.io/dbushell/debug/wGaamR"><b>Click here to view this demo properly on iOS devices (remove the top frame)</b></a>';
  document.body.insertBefore(p, document.body.querySelector('h1'));
}


/* Table JS End */

/* Notification */

	function menuToggle(){
	const toggleMenu = document.querySelector('.notif_menu');
	toggleMenu.classList.toggle('active')
}

/*Notification*/

/*** Inbox ***/



/*** Inbox ***/


