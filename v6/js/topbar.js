
function setFocusOnModal() {
    $('#searchModal').on('shown.bs.modal', function() {
        $('#searchBarInput').focus();
    });
}



// On Navbar Scroll
const onScroll = document.getElementById("desktopNav");
window.addEventListener("scroll", () => {
    if (window.scrollY < 500) {
        onScroll.classList.remove("scrolled");
    } else {
        onScroll.classList.add("scrolled");
    }
});
// End of Nabvar Scroll


// Dropdown on Hover
let dropdowns = document.querySelectorAll('.c-navbar-top-dropdown')

dropdowns.forEach((dropdown) => {
    dropdown.addEventListener('mouseenter', (e) => {
        if (dropdown.classList.contains('closed')) {
            dropdown.classList.remove('closed')
        }
    })
    dropdown.addEventListener('mouseleave', (e) => {
        if (!dropdown.classList.contains('closed')) {
            dropdown.classList.add('closed')
        }
    })
})
// End of Dropdown on Hover

// Mega Menu
const megaMenus = document.querySelectorAll('.mega-menu')

megaMenus.forEach((megaMenu) => {
    megaMenu.addEventListener('mouseenter', (e) => {
        megaMenu.classList.add('showed')
        // if (megaMenu.classList.contains('showed')) {
        //     megaMenu.classList.remove('showed')
        // }
    })
    megaMenu.addEventListener('mouseleave', (e) => {
        megaMenu.classList.remove('showed')
        // if (!megaMenu.classList.contains('showed')) {
        //     megaMenu.classList.add('showed')
        // }
    })
})
// End of Mega Menu



function clickmenumobileFunction() {
    $('#menu').css('transform', 'translate(0%, 0)');
}
