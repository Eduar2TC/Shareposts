//Expected register page is loaded
window.addEventListener( 'load', function () {
    'use strict';
    /* Icon likes and dislikes */
    const iconLink = document.querySelector('.float-end');
    const iconLike = document.querySelector('.like');
    const iconDisLike = document.querySelector('.dislike');

    const classLike = document.querySelector('.fa-thumbs-up');
    const classDisLike = document.querySelector('.fa-thumbs-down');

    const post = window.location.pathname.split("/").pop();
    

    iconLike.addEventListener('click', function( event ){
        event.preventDefault();
        let attribute = classLike.getAttribute('data-prefix');
                        classLike.classList.add('fa-1x');
        let likeValue = document.querySelector('.like-value').childNodes[0].textContent;

        if ( attribute === 'far' ) {
            //like
            classLike.setAttribute('data-prefix', 'fas');
            document.querySelector('.fa-thumbs-up').setAttribute('data-prefix', 'fas');
            iconLike.style.color = 'royalblue';
           //disLike
           classDisLike.setAttribute('data-prefix', 'far');
            document.querySelector('.fa-thumbs-down').setAttribute('data-prefix', 'far');
            iconDisLike.style.color = 'grey';
            getDataRatingPost( 'like' );
            
        } else if( attribute === 'fas' ) {
            //like
            classLike.setAttribute('data-prefix', 'far');
            document.querySelector('.fa-thumbs-up').setAttribute('data-prefix', 'far');
            iconLike.style.color = 'grey';
            //dislike
            classDisLike.setAttribute('data-prefix', 'far');
            document.querySelector('.fa-thumbs-down').setAttribute('data-prefix', 'far');
            iconDisLike.style.color = 'grey';
            getDataRatingPost('like' );
            //console.log('set to far');
        }
    });
    iconDisLike.addEventListener('click', function( event ){
        event.preventDefault();
        let attribute = classDisLike.getAttribute('data-prefix');
        classDisLike.classList.add('fa-1x');
        let dislikeValue = document.querySelector('.dislike-value').childNodes[0].textContent;

        if (attribute === 'far') {
            //dislike
            classDisLike.setAttribute('data-prefix', 'fas');
            document.querySelector('.fa-thumbs-down').setAttribute('data-prefix', 'fas');
            iconDisLike.style.color = 'royalblue';
            //like
            classLike.setAttribute('data-prefix', 'far');
            document.querySelector('.fa-thumbs-up').setAttribute('data-prefix', 'far');
            iconLike.style.color = 'grey';

            getDataRatingPost( 'dislike' );


        } else if( attribute === 'fas' ) {
            //dislike
            classDisLike.setAttribute('data-prefix', 'far');
            document.querySelector('.fa-thumbs-down').setAttribute('data-prefix', 'far');
            iconDisLike.style.color = 'grey';
            //like
            classLike.setAttribute('data-prefix', 'far');
            document.querySelector('.fa-thumbs-up').setAttribute('data-prefix', 'far');
            iconLike.style.color = 'grey';

            getDataRatingPost( 'dislike' );
        }
    });

    function getDataRatingPost( userClick ){

        fetch('http://localhost/Shareposts/posts/'+ userClick + '/' + post, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*'
            },
            mode: 'no-cors',
        }).then(function (response) {
            if (response.ok) {
                return response.json();
            } else {
                throw "Error en la llamada Ajax";
            }
        }).then(function (data) {

            try {
                console.log(data);
                document.querySelector('.like-value').childNodes[0].textContent = data.likes;
                document.querySelector('.dislike-value').childNodes[0].textContent = data.dislikes;
            }
            catch (error) {
                console.error("Not a JSON response");
            }
        }).catch(function (error) {
            console.log('Errors -> ' + error);
        });

    }

    function initStylesButtons(){
        let likeValue = document.querySelector('.like-value').childNodes[0].textContent;
        let dislikeValue = document.querySelector('.dislike-value').childNodes[0].textContent;

        if( likeValue == 1 ){
            document.querySelector('.fa-thumbs-up').setAttribute('data-prefix', 'fas');
            iconLike.style.color = 'royalblue';
        }
        if( dislikeValue == 1 ){
            document.querySelector('.fa-thumbs-down').setAttribute('data-prefix', 'fas');
            iconDisLike.style.color = 'royalblue';
        }

    }
});


document.addEventListener("DOMContentLoaded", function() {
    // Toast messages
    new bootstrap.Toast(document.querySelector('.toast')).show();
}, false);

/*const formulario = document.querySelector('.formulary');
formulario.addEventListener('submit', function (event) {
    event.preventDefault();
    var datas = new FormData(formulario);
    console.log(datas.get('resultado'));

    fetch('http://localhost/Shareposts/users/register', {
        method: 'POST',
        body: datas
    }).then(
        res => res.json()
    ).then(
        data => {
            console.log(data);
    }).catch(function () {
            console("Can't connect to backend try latter");
    });
});*/

/*window.addEventListener('DOMContentLoaded', function user_name( userName ){
    var name = userName;
    document.querySelector('.welcome').innerHTML += 
        '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">'+
        '< symbol id = "check-circle-fill" fill = "currentColor" viewBox = "0 0 16 16" >' +
            '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />'+
        '</symbol >'+
        '</svg >'+
        '<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">'+
            '<div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-animation="true">'+
                '<div class="d-flex">'+
                    '<div class="toast-body">'+
                        '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>'+
                            'Welcome again ' + name.type  +
                        '</div>'+
                    '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>'+
                '</div>'+
            '</div>'+
        '</div>';
    new bootstrap.Toast(document.querySelector('.toast')).show();
});*/
