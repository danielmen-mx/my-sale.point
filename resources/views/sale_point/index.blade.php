@extends('layouts.app')

@section('content')
<style>
    * { box-sizing: border-box; }
    body {
    font: 16px Arial;
    }

    .autocomplete {
    /*the container must be positioned relative:*/
    position: relative;
    display: inline-block;
    }

    input {
    border: 1px solid transparent;
    background-color: #f1f1f1;
    padding: 10px;
    font-size: 16px;
    }

    input[type=text] {
    background-color: #f1f1f1;
    width: 100%;
    }

    input[type=submit] {
    background-color: DodgerBlue;
    color: #fff;
    }

    .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;
    }

    .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
    /*when hovering an item:*/
    background-color: #e9e9e9;
    }

    .autocomplete-active {
    /*when navigating through the items using the arrow keys:*/
    background-color: DodgerBlue !important;
    color: #ffffff;
    }
</style>

<div class="container">
    <div class="card" style="width: 100%">
        <div class="card shadow">
            <div class="card">
                <h1>Search of products</h1>
                <div class="autocomplete full-width">
                    <input type="number" id="number" style="width: 3rem;" value=1>
                    <input type="text" id="formulario" class="my-2" style="width: 90%;">
                    <input type="button" class="btn btn-success" id="addProductBtn" value="Add">
                    @csrf
                </div>
            </div>
        </div>

        <div class="card-header">
            <table class="table">
                <thead class="table-info">
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Options</th>
                    </tr>
                </thead>
                
                <tbody class="table table-hover" id="carrito"></tbody>  {{-- this is the containt about the list of prodcuts --}}
            </table>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <h3>Total:</h3>
                    <h5 id="total_price"></h5>
                    <input type="submit" class="btn btn-success m-2" name="buyCarrito" style="width: 4rem;" value="Buy" onclick="vender()">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Json code to get the list of products -->
<script> 
    fetch('products/all-products')
    .then(response => response.json())
    .then(data => [
        products = data]);

    var products = [];
    var carrito = [];
// <-- Autocomplete function -->
    function autocomplete(inp)
    {
        // debugger
        var currentFocus;
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            closeAllLists();
            if (!val) {
                return false;
            };
            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            this.parentNode.appendChild(a);
            for (i = 0; i < products.length; i++) {
                if (products[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + products[i].name + "</strong>";
                    b.innerHTML += "<input type='hidden' value='" + products[i].name + "'>";
                        b.addEventListener("click", function(e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
    }

    function syncTotalProducts()
    {
        var totalPriceHTML = document.getElementById("total_price")
        totalPriceHTML.innerHTML = "$ " + getTotal();
    }
// <-- Make the view of the table -->
    function syncCarritoTableView()
    {
        var view_table = document.getElementById("carrito")
        view_table.innerHTML = ""
        for (let i = 0; i < carrito.length; i++)
        {
            let subtotal = carrito[i].product.sale_price * carrito[i].quantity
            view_table.innerHTML += `
                <tr>
                    <td>${carrito[i].product.name}</td>
                    <td>${carrito[i].product.brand}</td>
                    <td>$${carrito[i].product.sale_price}</td>
                    <td>${carrito[i].quantity} pzs</td>
                    <td>$${subtotal}</td>
                    <td>
                        <button onclick="deleteProduct()" class="btn btn-danger">Delete</button>
                   </td>
                </tr>
                `
        }
    }
// <-- Push the data to the carrito array -->
    function pushOrModifyCarrito (element, quantity)
    {
            // use 'debugger' to verify step by step what ejecutes in the method/function...
        for (let i = 0; i < carrito.length; i++)
        {
            if (carrito[i].product.id == element.id)
            {
                carrito[i].quantity += quantity;        // <--- Increase the quantity from a product.
                //let quantityResult = carrito[i].quantity + quantity // 2
                // let newElement = {
                //     product: element,
                //     quantity: quantityResult
                //     }
                // carrito.splice(i,1, newElement)      // This is another way to increase the quantity, but is more code, the better option is already up...
                return
            }
        }
        carrito.push ({
            product: element,
            quantity: quantity
        });
    }

    function addProduct()
    {
        let productNameToSearch = document.getElementById("formulario").value;
        let quantity = document.getElementById("number").value;
        quantity = parseInt(quantity);
        for (let i = 0; i < products.length; i++)
        {
            if (products[i].name == productNameToSearch)
            {
                pushOrModifyCarrito(products[i], quantity)
                syncCarritoTableView()
                syncTotalProducts()
            }
        }
    }

    function getTotal(){
        var total = 0
        for (let i = 0; i < carrito.length; i++) {
            let subtotal = carrito[i].product.sale_price * carrito[i].quantity
            total += subtotal
        }
        return total
    }

    function vender() {
        const csrf = document.getElementsByName('_token')[0].value;

        fetch('/sales/',        // es hacer una peticion al servidor... (AJAX)
        {
            method: 'POST',
            body: JSON.stringify
            ({      // es una funcion que recibe un json y lo que envio lo vuelve en string
                total: getTotal(),
                description: carrito,
                _token: csrf
            }),
            headers: 
            {
                "Content-type": "application/json; charset=UTF-8"
            }
        })
        .then(response => response.json())
        .then(data =>
        {
            debugger
            location.replace('/sales/' + data.id)
        });

    }

    addProductBton = document.getElementById("addProductBtn");

    addProductBton.addEventListener('click', addProduct);

    function addActive(x)
    {
            if (!x) return false;
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = (x.length - 1);
                        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x)
    {
        for (var i = 0; i < x.length; i++)
        {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt)
    {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++)
        {
            if (elmnt != x[i] && elmnt != inp)
            {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    document.addEventListener("click", function(e)
    {
        closeAllLists(e.target);
    });

    var inp = document.getElementById("formulario")
    autocomplete(inp);

    function deleteProduct(i)
    {
        carrito.splice(i, 1)
        syncTotalProducts()
        syncCarritoTableView()
    }

</script>
@endsection