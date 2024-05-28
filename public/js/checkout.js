document.addEventListener('DOMContentLoaded', function() {
    const creditCardBtn = document.getElementById('credit-card-btn');
    const codBtn = document.getElementById('cod-btn');
    const momoBtn = document.getElementById('momo-btn');
    const cardDetails = document.getElementById('card-details');
    const cardNumber = document.getElementById('card-number');
    const cardExpiryCvc = document.getElementById('card-expiry-cvc');
    // const saveCardContainer = document.getElementById('save-card-container');

    // Function to hide card details
    function hideCardDetails() {
        cardDetails.classList.add('hidden');
        cardNumber.classList.add('hidden');
        cardExpiryCvc.classList.add('hidden');
        // saveCardContainer.classList.add('hidden');
    }

    function removeActiveClass() {
        creditCardBtn.classList.remove('active');
        codBtn.classList.remove('active');
        momoBtn.classList.remove('active');
    }
    hideCardDetails();

    creditCardBtn.addEventListener('click', function() {
        removeActiveClass(); // Remove active class from all buttons
        creditCardBtn.classList.add('active'); // Add active class to the clicked button
        cardDetails.classList.remove('hidden');
        cardNumber.classList.remove('hidden');
        cardExpiryCvc.classList.remove('hidden');
        // saveCardContainer.classList.remove('hidden');
    });

    codBtn.addEventListener('click', function() {
        removeActiveClass(); // Remove active class from all buttons
        codBtn.classList.add('active'); // Add active class to the clicked button
        hideCardDetails();
    });

    momoBtn.addEventListener('click', function() {
        removeActiveClass(); // Remove active class from all buttons
        momoBtn.classList.add('active'); // Add active class to the clicked button
        window.location.href = 'http://example.com';
    });

    products.forEach(product => {
        print(product.Quantity, product.Name , product.Price, product.Image ,product.Size);
    })
});



var products = [
    {
        Name: "Pochacco",
        Product_ID: "001",
        Size: "Iphone 15",
        Price: 29.99,
        Quantity: 10,
        Image: "/pepicase/public/product-pics/pompompurin/1.svg"
    },
    {
        Name:"Cinnamonrol",
        Product_ID: "002",
        Size: "Iphone 13",
        Price: 39.99,
        Quantity: 5,
        Image: "/pepicase/public/product-pics/pochacco/2.svg"
    }]

function print(quantity, name, price, pathing, size) {
    var block = document.createElement("div");
    block.className = "lexend";
    block.style = "width: 80%;height:fit-content; padding: 0; margin: 0; margin-top: 5vh;"
    // Thêm HTML cho mỗi sản phẩm trong mảng products
    block.innerHTML = `
            <div class="cart-item">
                <div class="image-container">
                    <img src="${pathing}" alt="${size}">
                </div>
                <div class="item-details">
                    <p>Name: ${name}</p>
                    <p>Model: ${size}</p>
                    <p>Price: $${price}</p>
                    <p>Quantity: ${quantity}</p>
                </div>
            </div>
        `;
    document.getElementById('item_div').appendChild(block);
};

var shipping={
    value:20
}
//tính tổng tiền
function calculateTotal() {
    var subtotal_value = products.reduce((acc, product) => acc + product.Price * product.Quantity, 0);
    // var shipping = parseFloat(document.getElementById('shipping').innerText);
    var total= subtotal_value + shipping.value;
    // document.getElementById('shipping').innerHTML=`${shipping.value}$`;
    document.getElementById('subtotal').innerText = `${subtotal_value.toFixed(2)}$`;
    document.getElementById('total').innerText = `${total.toFixed(2)}$`;
}
document.addEventListener('DOMContentLoaded', function()
{
   calculateTotal();
}
)

//sự kiện nhập mã giảm giá:
var voucher = {
    code: "pepi20",
    value: 0.2
};

document.getElementById('apply-discount').addEventListener('click', function() {
    var subtotal= document.getElementById('subtotal');
    var total=document.getElementById('total');
    var discount_alert=document.getElementById('discount-alert');
    var discountCode = document.getElementById('discount-code').value;
    if (discountCode === voucher.code) {
        var subtotal_value = products.reduce((acc, product) => acc + product.Price * product.Quantity, 0);
        var discountAmount = subtotal_value * voucher.value;
        var total_value = subtotal_value - discountAmount + shipping.value;
        subtotal.innerText = `${subtotal_value.toFixed(2)}$`;
        total.innerText = `${total_value.toFixed(2)}$`;
        discount_alert.innerText = `Mã giảm giá hợp lệ!`;
        discount_alert.style.color='green';
        document.getElementById('discount_text').style.display='block';
        document.getElementById('discount_money').style.display='block';
        document.getElementById('discount_money').innerText = `-${discountAmount.toFixed(2)}$`;
    } else {
        discount_alert.innerText = `Mã giảm giá không hợp lệ!`;
        discount_alert.style.color='red';
        document.getElementById('discount_text').style.display='none';
        document.getElementById('discount_money').style.display='none';
    }
});
