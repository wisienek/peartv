
<script>
    const pages = { "profile.php": "home", "movies.php": "movies", "list.php": "myList"};
    let pageLocation = document.location.pathname.split("/").reverse()[0].replace(/#.*/g, "").replace(/\?.*/g, "");

    $(`#${pages[pageLocation]}`).attr("aria-current", "page");
    $(`#${pages[pageLocation]}`).toggleClass("active");


</script>

</body>
</html>