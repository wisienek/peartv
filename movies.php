<?php
    require('./includes/head.php');
?>

<div class="container content" id="movieList" style="margin-top: 20px; margin-bottom: 5vh;">


    <div>
        <h2>Popularne</h2>
        <div class="container karuzela" id="popularne"></div>
    </div>

    <div>
        <h2>Nadchodzące</h2>
        <div class="container karuzela" id="nowe"></div>
    </div>


</div>


<script>

const popularne = "https://api.themoviedb.org/3/discover/movie?api_key=YOURAPIKEY&sort_by=popularity.desc&include_adult=true&include_video=false&page=1";
const nowe = "https://api.themoviedb.org/3/discover/movie?api_key=YOURAPIKEY&sort_by=release_date.desc&include_adult=true&include_video=false&page=1";

$.get(popularne, data=>{
    if(data.results){
        data.results.forEach(res=>{
            let poster = res.poster_path? "https://www.themoviedb.org/t/p/w220_and_h330_face" + res.poster_path: "https://via.placeholder.com/220x330.png?text=No+poster+yet";
            let data = new Date(res.release_date).toDateString()

            $(`
            <div class="movieSummary">
                <div class="voteAvg noTuch">${res.vote_average}</div>
                <a href="selected.php?id=${res.id}">
                    <img loading="lazy" class="poster" src="${poster}" alt="Poster">
                    <h5 class="summaryTitle">${res.original_title}</h5>
                </a>
                <p class="summaryDate">${data}</p>
            </div>`).appendTo("#popularne");
        });
    }
}); 

$.get(nowe, data=>{
    if(data.results){
        data.results.forEach(res=>{
            let poster = res.poster_path? "https://www.themoviedb.org/t/p/w220_and_h330_face" + res.poster_path: "https://via.placeholder.com/220x330.png?text=No+poster+yet";
            let data = new Date(res.release_date).toDateString()

            $(`
            <div class="movieSummary">
                <div class="voteAvg noTuch">${res.vote_average}</div>
                <a href="selected.php?id=${res.id}">
                    <img loading="lazy" class="poster" src="${poster}" alt="Poster">
                    <h5 class="summaryTitle">${res.original_title}</h5>
                </a>
                <p class="summaryDate">${data}</p>
            </div>`).appendTo("#nowe");
        });
    }
}); 

</script>

<?php
    require('./includes/footer.php');
?>