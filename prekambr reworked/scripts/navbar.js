  const button = document.getElementById('navbutton');
        const navlist = document.getElementById('list');
        button.addEventListener('click',showNav);
        function showNav (){
            button.classList.toggle('visible');
            navlist.classList.toggle('displayed');
        }