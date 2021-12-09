@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Link Customer</div>
                <div class="card body">
                    <div class="col">
                        <h4>Search Customer</h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <input type="text" id="searchCustomer" onkeyup="suggestCustomer()" style="width: 90%;">
                            <button type="button" class="btn btn-sm" value="Search" onclick="addCustomer()">Link</button>
                            <div id="suggestedCustomer"></div>

                            <input type="hidden" id="sale_id" value="{{ $sale->id }}">
                            @csrf
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4>Add new customer</h4>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                        </div>
                        @endif
                    <form>
                        <div class="form-group">
                            <label>First Name *</label>
                            <input type="text" name="first_name" id="first_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Last Name *</label>
                            <input type="text" name="last_name" id="last_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Birthday</label>
                            <input type="date" name="birthday" id="birthday" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <input type="button" value="Enter" onclick="createNewCustomer()" class="btn btn-sm btn-success">
                        </div>
                    </form>
                    <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-warning">Back</a>
                </div> 
            </div>
        </div>
    </div>
</div>

<script>
    // <--- Search bar --->
    var costumers = [];
    var costumersList = [];
    
    getCostumers()
    
    async function getCostumers()   // la funcion await no puede ser usada sin un async, de otro modo te marcará error...
    {
        costumers =  await (await fetch('/costumers/get-costumers')).json()    
        
        // fetch('/costumers/get-costumers')    este es otro modo de mandar llamar el arreglo usando fetch, ambas dan el mismo resultado
        // .then(response => response.json())
        // .then(data => costumers = data);
    }
    
    function suggestCustomer()
    {
        const termToSearch = document.getElementById('searchCustomer').value.trim().toUpperCase(); // la función trim nos sirve para eliminar espacios al inicio y final de los strings, toUpperCase nos sirve para reescribir todo en mayus
        const suggestedCustomerHTML = document.getElementById('suggestedCustomer');
        
        suggestedCustomerHTML.innerHTML = '' // de este modo limpiamos con cada tecla el buscador y nos permite reenderizar una lista con los resultados
        
        costumers.forEach(item => {
            
            const customerLargeName = (item.first_name + " " + item.last_name).toUpperCase()
            
            if (customerLargeName.includes(termToSearch)) {
                suggestedCustomerHTML.innerHTML += `
                <div onclick='completeSearchTerm(${item.id})'>
                ${customerLargeName}
                </div>
                `
            }
        })
    }
    
    function abortSuggest()
    {
        const suggestCustomerHTML = document.getElementById('suggestedCustomer');   // de este modo limpiamos el buscador una vez seleccionado
        suggestCustomerHTML.innerHTML= ''
    }
    
    function completeSearchTerm(id)
    {
        costumers.forEach(costumer => {
            if (costumer.id == id) {
                document.getElementById('searchCustomer').value = costumer.first_name + ' ' +  costumer.last_name
                document.getElementById('suggestedCustomer').innerHTML = ''
                return;
            }
        });
    }
    
    async function addCustomer()
    {
        const termToSearch = document.getElementById('searchCustomer').value.trim().toUpperCase();
        
        for (let i = 0; i < costumers.length; i++) {
            let names = costumers[i].first_name + ' ' +costumers[i].last_name;

            if (names.toUpperCase() == termToSearch) {
                fetchLinkCostumer(costumers[i]);
            }
        }
    }

    // <--- Create customer --->
    async function createNewCustomer()
    {
        let firstName = document.getElementById('first_name').value;
        let lastName = document.getElementById('last_name').value;
        let birthday = document.getElementById('birthday').value;
        let email = document.getElementById('email').value;
        let phone = document.getElementById('phone').value;
        const csrf = document.getElementsByName('_token')[0].value;
        const sale_id = document.getElementById('sale_id').value;

        const payload = {
            'first_name': firstName,
            'last_name': lastName,
            'birthday': birthday,
            'email': email,
            'phone': phone,
            _token: csrf // is necesary because the route has a middleware...
        }
        const settings =  {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json' 
            },         
            body: JSON.stringify(payload)
        }
        
        const response =  await (await fetch('/api/costumers/', settings)).json()

        fetchLinkCostumer(response);
    }

    // <-- Link the customer with the sale -->
    async function fetchLinkCostumer(costumer)
    {
        const csrf = document.getElementsByName('_token')[0].value;
        const sale_id = document.getElementById('sale_id').value;

        const payload = {
            costumer_id: costumer.id,
            _token: csrf
        }
        const settings =  {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json' 
            },         
            body: JSON.stringify(payload)
        }
        
        // var URLactual = window. location;   // usamos esto ya que el frontend no sabe que existe un id de sale, accedemos a la ubicacion de la url y la guardamos en una variable
        // let arr = URLactual.pathname.split('/'); // hacemos un split para que nos devuelva la url en forma de un arreglo, usamos la consola para identificar donde se encuentra nuestro id de sale y lo especificamos en la ruta...
        
        const response =  await (await fetch('/sales/'+ sale_id +'/linkCostumer', settings)).json()

        location.replace('/sales/' + response.id)
    }
</script>
        
@endsection