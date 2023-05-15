 <footer>
<div class="pull-right">
<div class="row">
        <div class="col-12">
          <p class="text-right">Developed by <b>
          <a href="https://nationalpolymer.net/" target="_blank">
            <span style="color:blue;">IT & MIS</span>
            <span style="color:blue;">Department</span>
          </a>
        </p>
        </div>
      </div>
</div>
<div class="clearfix"></div>
</footer>
<div class="ajaxLoaderFormLoad" style="
  height: 100px;
  width: 100px;
  position: fixed;
  left: 50%;
  top: 35%;
  z-index: 9999999;
  background-color: #F1F2F3;
  padding-top: 15px;
  border-radius: 3px;
  display:none;">

    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#F1F2F3;display:block;" width="70px" height="70px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
    <g>
        <path d="M50 18A32 32 0 1 0 79.93420898655576 38.688804999063784" fill="none" stroke="#e15b64" stroke-width="4"></path>
        <path d="M49 18L49 18L49 18L49 18" fill="#e15b64"></path>
        <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="0.8474576271186441s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
    </g>
    </svg>
</div>
<script>
    // disable enter key
    document.addEventListener('keypress', function (e) {
        if (e.keyCode === 13 || e.which === 13) {
            e.preventDefault();
            return false;
        }

    });
</script>


<script>

var url = window.location;
const allLinks = document.querySelectorAll('.sidebar-menu a');
const currentLink = [...allLinks].filter(e => {
  return e.href == url;
});

currentLink[0].classList.add("active")
currentLink[0].closest(".child_menu").style.display="block";
//currentLink[0].closest(".has-treeview").classList.add("active");


    // var url = window.location;
    // const allLinks = document.querySelectorAll('.nav-item a');
    // const currentLink = [...allLinks].filter(e => {
    //     return e.href == url;
    // });
    // currentLink[0].classList.add("active");
    // currentLink[0].closest(".nav-treeview").style.display = "block ";
    // currentLink[0].closest("ul.nav-treeview").closest('li').classList.add('menu-open');
    // $('.menu-open').find('a').each(function() {
    //     if (!$(this).parents().hasClass('active')) {
    //         $(this).parents().addClass("active");
    //         $(this).addClass("active");
    //     }
    // });
    </script>
