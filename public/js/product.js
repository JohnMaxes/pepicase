var quantity = 1;
var total;
var starArr = [];
var current_sizing = 0, previous_sizing, finalized_size;
var isFavoritedNow = isFavorited;

$(document).ready(function() {
    total = quantity * price;
    $("#add_to_cart_button").text("Add to Cart - $" + total + " USD");
    
    $(".sizing").each(function() {
        $(this).val($(this).text());
    });
    
    $(".sizing").click(function() 
    {
        if (this === current_sizing) return;
        
        if (current_sizing === 0) {
            $(this).css("background-color", "#FFE57A");
            current_sizing = this;
            finalized_size = $(this).val();
        } else {
            previous_sizing = current_sizing;
            $(this).css("background-color", "#FFE57A");
            current_sizing = this;
            $(previous_sizing).css("background-color", "white");
            finalized_size = $(this).val();
        }
    });
    $("#curr_quantity").text(quantity);
    var starArr = $(".review_star");
    console.log(starArr);
    
    $(".review_star").click(function() {
        var index = $(this).data("value");
    
        for (let u = index - 1; u > -1; u--) {
            $(starArr[u]).prop("src", "http://localhost/pepicase/public/pics/review_star_shaded.svg");
        }
    
        for (let u = index; u < starArr.length; u++) {
            $(starArr[u]).prop("src", "http://localhost/pepicase/public/pics/review_star.svg");
        }
    });

    $("#add_to_cart_button").click(function() {
        console.log(product_id);
        console.log(user);
        console.log(finalized_size);
        console.log(quantity);

        if(finalized_size == null) $("#combotext").text("Please pick a size!");
        else
        {
            $.ajax({
                type: "POST",
                url: "http://localhost/pepicase/public/product/add",
                data: {
                    product: product_id,
                    user_id: user,
                    size: finalized_size,
                    quantity: quantity,
                    name: product_name,
                    price: price,
                },
                success: function(response) {
                    console.log(response);
                    $("#combotext").css("color", "green");
                    $("#combotext").text("You have added " + quantity + " items to your cart successfully!");
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    var errorMessage;
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        // If the server returned a JSON response with a 'message' property, use that
                        errorMessage = xhr.responseJSON.message;
                    } else {
                        // Otherwise, use the status text or the error parameter
                        errorMessage = xhr.statusText || error;
                    }
                    console.error("Error adding item to cart: ", errorMessage);
                }
            });
        }
    });
});

function toggleFavorite() 
{
    var fav_icon = $("#favorite");
    if (fav_icon.attr("src") === "http://localhost/pepicase/public/pics/favorite_icon_shaded.svg") 
    {
        fav_icon.attr("src", "http://localhost/pepicase/public/pics/favorite_icon.svg")
        isFavoritedNow = 'no';
    }
    else 
    {
        fav_icon.attr("src", "http://localhost/pepicase/public/pics/favorite_icon_shaded.svg");
        isFavoritedNow = 'yes';
    }
};

function add() {
    quantity++;
    $("#curr_quantity").text(quantity);
    total = price * quantity;
    $("#add_to_cart_button").text("Add to Cart - $" + total + " USD");
}

function minus() {
    if(quantity > 0)
    {
        quantity--;
        $("#curr_quantity").text(quantity);
        total = price * quantity;
        $("#add_to_cart_button").text("Add to Cart - $" + total + " USD");        
    }
}

$(window).on('beforeunload', function() 
{
    if(isFavoritedNow !== isFavorited)
    {
        $.post('http://localhost/pepicase/public/product/toggleFavorite', {
            product: product_id,
            user_id: user,
        })
    }
});

function createFeedback(name, rating, comment, date) {
    const feedbackContainer = document.createElement('div');
    feedbackContainer.classList.add('feedback');
  
    const nameElement = document.createElement('h3');
    nameElement.textContent = name || 'Anonymous';
  
    const ratingElement = document.createElement('div');
    ratingElement.classList.add('rating');
    for (let i = 0; i < 5; i++) {
      const starElement = document.createElement('i');
      starElement.classList.add('fa', 'fa-star');
      if (i < rating) {
        starElement.classList.add('fa-solid');
      } else {
        starElement.classList.add('fa-regular');
      }
      ratingElement.appendChild(starElement);
    }
  
    const commentElement = document.createElement('p');
    commentElement.textContent = comment;
  
    const dateElement = document.createElement('span');
    dateElement.textContent = date;
  
    feedbackContainer.appendChild(nameElement);
    feedbackContainer.appendChild(ratingElement);
    feedbackContainer.appendChild(commentElement);
    feedbackContainer.appendChild(dateElement);
  
    return feedbackContainer;
  }
  
  function printFeedback(name, rating, comment, date) {
    var block = document.createElement("div");
    block.className = "lexend";
    block.style = "width: 80%; padding: 10px; margin: 10px auto; border: 1px solid #ccc;";
    block.innerHTML = `
      <div class="feedback-header">
        <div style="font-weight: bold;">${name}</div>
        <div style="font-size: 12px; color: #666;">${date}</div>
      </div>
      <div class="feedback-rating">
        ${createStars(rating)}
      </div>
      <div class="feedback-comment">
        ${comment}
      </div>
    `;
    document.getElementById("feedback-container").appendChild(block);
  }
  
  function createStars(rating) {
    var stars = "";
    for (let i = 0; i < 5; i++) {
      if (i < rating) {
        stars += "★";
      } else {
        stars += "☆";
      }
    }
    return stars;
  }
  
  // Example usage
  printFeedback("Anonymous", 4, "so cuteee luv it soo much!!", "Jan 1, 2024");
  printFeedback("Anonymous", 5, "luv it soo much!! luv it soo much!! luv it soo much!! luv it soo much!!", "Jan 1, 2024");
  printFeedback("Anonymous", 4, "so cuteee luv it soo much!!", "Jan 1, 2024");
  
    const loadMoreButton = document.createElement('button');
    loadMoreButton.textContent = 'Load more';
    feedbackSection.appendChild(loadMoreButton);
  
  window.onload = () => {
    addFeedbacks();
  };