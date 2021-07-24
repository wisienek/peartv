<?php
    include('./includes/head.php');
?>

<div class="movieInfo">

    <div class="movieMain">
        <div class="imgWraper">
            <img class="poster" />
            <button type="button" class="btn btn-success rentButton">Wypożycz</button>
        </div>
        <div class="movieInfoText">
            <div class="title">
                <h2>The Honest Thief <small class="text-muted">(2020)</small></h2>
                <div class="titleMore">
                    <span class="badge pg">PG 18</span>
                    <span class="genres">Thriller, Action, Crime, Drama</span>
                    <span class="length">1h 40m</span>
                </div>
            </div>
            <div class="overview">
                <h3>Overview</h3>
                <span>A bank robber tries to turn himself in because he's falling in love and wants to live an honest life...but when he realizes the Feds are more corrupt than him, he must fight back to clear his name.</span>
            </div>

        </div>
        
    </div>

    <div class="container">
        <h3 style="color: white">Cast</h3>
        <div class="container cast"></div>
    </div>





</div>

<script>
    //api = YOURAPIKEY
    let id = document.location.search.match(/id=\d*/g);

    
    if(!id){
        location.replace("http://localhost/peartv/movies.php");
        alert("Nie ma id!");
    }else{
        id = id[0].split("=")[1];

        const movieInfo = `https://api.themoviedb.org/3/movie/${id}?api_key=YOURAPIKEY`;
        const credits = `https://api.themoviedb.org/3/movie/${id}/credits?api_key=YOURAPIKEY`;


        $.get(movieInfo, data=>{
            if(data.title){
                $(".movieInfo").css("background-image", `linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url(https://www.themoviedb.org/t/p/w1920_and_h800_multi_faces${data.backdrop_path})`);
                $(".poster").attr('src', data.poster_path? "https://www.themoviedb.org/t/p/w300_and_h450_bestv2"+data.poster_path : "https://via.placeholder.com/300x450.png?text=No+poster+yet");
                $(".title h2").html(data.title + `<small class="text-muted"> ${data.release_date? "("+data.release_date.split("-")[0]+")" : ""} </small>`);
                $(".pg").text(data.adult==true? "PG 16": "PG 13").addClass(data.adult==true? "bg-danger": "bg-success");
                $(".genres").text( `${data.genres.map(g=> g.name).join(", ")}` );
                $(".length").text( `${parseInt(data.runtime/60)}h ${parseInt(data.runtime%60)}m` );
                $(".overview span").text( data.overview );

                $.get(`http://localhost/peartv/server/rented.php` , res => {
                    if(res.indexOf(id)>-1){
                        //<button type="button" class="btn btn-success rentButton">Wypożycz</button>
                        $('button').toggleClass("rentButton").toggleClass("btn-success").toggleClass("btn-primary").text("Wypożyczony!")
                        .click(()=>{
                            window.location.href = "http://localhost/peartv/list.php";
                        });
                    }
                });

                $(".rentButton").click(()=>{
                    console.log("wypożyczono "+id);
                    $.get(`http://localhost/peartv/server/rent.php`, {id} )
                    .done(res=>{
                        alert(res);
                        if(res.indexOf("Dodano film")>-1){
                            $('button').toggleClass("rentButton").toggleClass("btn-success").toggleClass("btn-primary").text("Wypożyczony!")
                            .click(()=>{
                                window.location.href = "http://localhost/peartv/list.php";
                            });
                        }
                    });
                });
            }
        });
        $.get(credits, data=>{
            if(data.cast){
                data.cast.splice(0, 9).forEach(member=>{
                    $(`<div class="card">
                            <a href="https://www.themoviedb.org/person/${member.id}-${member.original_name.replace(/\s/g, "-").toLowerCase()}"> <img loading="lazy" class="card-img-top" src="${member.profile_path? `https://www.themoviedb.org/t/p/w138_and_h175_face${member.profile_path}`: "https://via.placeholder.com/138x175.png?text=No+profile" }" alt="${member.name}"> </a>
                            <h5 class="card-title">${member.name}</h5>
                            <p class="card-text">${member.character}</p>
                        </div>`)
                    .appendTo(".cast");
                });
            }
        });
    }


</script>

<?php
    include('./includes/footer.php');
?>