(function(){
    let catcells =[...document.querySelectorAll('.category')];
    catcells.forEach(function (catcell) {
        if (catcell.innerText === 'REGULAR') {
            catcell.classList.add('alert-info');
        }
        else if (catcell.innerText === 'VVIP') {
            catcell.classList.add('alert-danger');
        }
        else if (catcell.innerText === 'VIP') {
            catcell.classList.add('alert-warning');
        }
        else {
            catcell.classList.add('alert-success');
        }
    })
})();





