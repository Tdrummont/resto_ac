class ListGroup {
    constructor() {
    	//Nome do exercício
        this._list = document.querySelectorAll('.list-group-item strong');

        //Grupo - Grupo muscular
        this._listGroup = document.querySelectorAll('.list-group-item .list-group-item-text');
        
        this._newList = this._list;
    }

    search(palavra) {
		if(palavra){
			this._newList.forEach((e, v) => {
				let strLista = e.textContent.toLowerCase();
				let strDigitada = palavra.toLowerCase();
				let strGroup = this._listGroup[v].textContent.trim().toLowerCase();

				if(strLista.indexOf(strDigitada) === -1 && strGroup.indexOf(strDigitada) === -1){ 
					this._list[v].parentNode.classList.add('hidden'); 
				}
				else {
					this._list[v].parentNode.classList.remove('hidden'); 
				}
			});
		}else {
			this._newList.forEach((e) => {
				e.parentNode.classList.remove('hidden'); 
			});
		}
	}
}