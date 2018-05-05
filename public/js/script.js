var autoCorrect = function(phrase) {
    $(phrase).fadeOut(function () {
        phrase.innerHTML = 'Il y a des fautes dans cette phrase. Cliquez ici pour les corriger.';
    });

    $(phrase).fadeIn();
};