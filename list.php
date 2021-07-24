<?php
    require("./includes/head.php");
?>


    <div class="content" style="padding-top: 3vh; padding-bottom: 3vh;">
        <h1 style="color: white">My list</h1>
        <div class="myList"></div>
    </div>


    <script>
        //api = YOURAPIKEY

        $.get(`http://localhost/peartv/server/rented.php` , res => {
          try{
            let x = JSON.parse(res);

            x.forEach(rented=>{
              let id = rented.movie_id;
              if(!id) { throw "Brak id!" }
              const movieInfo = `https://api.themoviedb.org/3/movie/${id}?api_key=YOURAPIKEY`;

              $.get(movieInfo, data=>{
                if(!data.title){ throw "Brak tytułu"; }
                $(`<div class="listMovie">
                    <img src="${data.backdrop_path? "https://www.themoviedb.org/t/p/w1280_and_h720_multi_faces" +data.backdrop_path : "https://via.placeholder.com/1280x720.png?text=No+poster+yet"}" alt="poster">

                    <div class="listMovieHidden" id="${id}">
                      <h4>${data.title}</h4>
                      <div class="listMovieInfo">
                        <div>
                          <div class="liked noTuch">${data.vote_average * 10}% liked this movie</div>
                          <span class="badge ${data.adult==false? "bg-success": "bg-danger"} pg">PG ${data.adult==true? "18": "13"}</span>
                          <span class="length">${parseInt(data.runtime/60)}h ${parseInt(data.runtime%60)}m</span>
                        </div>
                        <span class="genres">${data.genres.map(g=> g.name).join(", ")}</span>
                      </div>
                    </div>
                  </div>`)
                .appendTo(".myList");
              });


            });

          } 
          catch(er){
            console.error(er);
          }
        });


    </script>





<?php
    require("./includes/footer.php");
?>