
// alert('bonjour');

function onClickBtnLike(event) {
    // alert('iin fonction');
    event.preventDefault();

    const url = this.href;
    const spanCount = this.querySelector('span.js-likes');
    const spanLabel = this.querySelector('span.js-label');
    const icone = this.querySelector('i');

    axios.get(url).then(function (response) {
        spanCount.textContent = response.data.likes;
        // alert('bonj')
        if (icone.classList.contains('fas')) {
            icone.classList.replace('fas', 'far');
            spanLabel.textContent = "j'aime"
        } else {
            icone.classList.replace('far', 'fas');
            spanLabel.textContent = "je n'aime plus"
        }
    }).catch(function (error) {
        if (error.response.status === 401) {
            // A modifie
            window.alert("Vous ne pouvez pas aimer un article si vous n'êtes pas connecter !");
        } else {
            window.alert("Une erreur s'est produite, réessayez plus tard.");
        }
    });
}

document.querySelector('a.js-like').addEventListener('click', onClickBtnLike);