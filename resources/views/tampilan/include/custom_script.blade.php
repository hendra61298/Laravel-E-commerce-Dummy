 <!-- Latest jQuery form server -->
 <script src="https://code.jquery.com/jquery.min.js"></script>

<!-- Bootstrap JS form CDN -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- jQuery sticky menu -->
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.sticky.js') }}"></script>

<!-- jQuery easing -->
<script src="{{ asset('js/jquery.easing.1.3.min.js') }}"></script>

<!-- Main Script -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>



<!-- Slider -->
<script type="text/javascript" src="{{ asset('js/bxslider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/script.slider.js') }}"></script>

<script>
function convertPriceToNumber(num){
    return parseInt(num.toString().split(".").join(""));
}
function convertNumberToPrice(num){
    num = num.toString().split(".").join("");
    return num.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}

let arraychart = JSON.parse(localStorage.getItem('cart'));
if (arraychart==null){
    localStorage.setItem('cart', JSON.stringify([]));
    arraychart = [];
}

updateHeaderCart();
function updateHeaderCart(){
    let total_item = 0;
    let total_price = 0;
    for(var i=0;i<arraychart.length;i++){
        total_item = total_item + arraychart[i]["jumlah"];
        total_price = total_price + arraychart[i]["price"];
    }
        
    $("#select_total").html(total_item);
    $("#price_total").html("Rp "+convertNumberToPrice(total_price));
    $("#price_totalchart").html("Rp "+convertNumberToPrice(total_price));
    console.log(arraychart);
    
}

function addtochart(id,price,jumlah,img_url,name){
    @if (Auth::check())
        if (arraychart.filter(e => e.id === id).length > 0) {
            index = arraychart.map(function(e) { return e.id; }).indexOf(id);
            if (jumlah > arraychart[index]["jumlah"]){
                arraychart[index]["price"] = parseInt(arraychart[index]["price"]) + parseInt(price)
                arraychart[index]["jumlah"] = arraychart[index]["jumlah"] + 1

            }else {
                alert('Stock tidak mencukupi');
            }
        } else {
            if (jumlah >= 1){
                arraychart.push({
                    "id" : id,
                    "price" : parseInt(price),
                    "jumlah" : 1,
                    "img_url": img_url,
                    "name":name,
                    "total":jumlah,
                    
                });
            
            }else{
                alert('Stock tidak mencukupi');
            }
        } 
    
        localStorage.setItem('cart', JSON.stringify(arraychart));
        updateHeaderCart();

        
        //set to UI
    @else
        Swal.fire(
            'Silahkan Login Terlebih Dahulu',
            'Login info',
            'info'
        ).then((result) => { });
    @endif
        
}
     
       
</script>