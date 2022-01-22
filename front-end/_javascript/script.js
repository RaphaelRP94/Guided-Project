let cart = [];
let key = 0;
let modelsQt = 0;

const c = (el)=>document.querySelector(el); // I set this variable so I did not need to type the same command over and over.

modelsJson.map((item, index)=>{//It takes the products like if they were in a databases
  let modelsItem = c('.models .models-item').cloneNode(true);//It makes copies of all children from these elementes 
  //I set all the information that will replace those children's elements
  modelsItem.setAttribute('data-key', index);
  modelsItem.querySelector('.models-item--img img').src = item.img;
  modelsItem.querySelector('.models-item--price').innerHTML = `${item.price[0].toFixed(2)}€`;
  modelsItem.querySelector('.models-item--name').innerHTML = item.name;
  
  modelsItem.querySelector('a').addEventListener('click', (e)=>{
    e.preventDefault();
    key = e.target.closest('.models-item').getAttribute('data-key');
    modelsQt = 1;
    c('.modelsBig img').src = modelsJson[key].img;
    c('.modelsInfo h2').innerHTML = modelsJson[key].name;
    c('.modelsInfo--actualPrice').innerHTML = `${modelsJson[key].price}€`;
    c('.modelsInfo--qt').innerHTML = modelsQt;
    c('.modelsWindowsArea').style.opacity = 0;// It makes the windows that is going to pop up "invisible".
    c('.modelsWindowsArea').style.display = 'flex';
    setTimeout(() => {
      c('.modelsWindowsArea').style.opacity = 1;// It makes it visible.
    }, 200);
  });
  c('.model-area').append(modelsItem);
});

//actions in the modal window

function closeModel() {
  c('.modelsWindowsArea').style.opacity = 0;
  setTimeout(() => {
    c('.modelsWindowsArea').style.display = 'none';
  }, 500);
};

c('.modelsInfo--cancelButton').addEventListener('click', closeModel);

c('.modelsInfo--qtless').addEventListener('click', ()=>{
  if(modelsQt > 1){ //Items can't go negative
    modelsQt--;
  c('.modelsInfo--qt').innerHTML = modelsQt;
  }
});

c('.modelsInfo--qtmore').addEventListener('click', ()=>{
  if(modelsQt < 2){ // I set 2 as the maximun amount a customer can "reserve" of the same item because it's a small garage
    modelsQt++;
  c('.modelsInfo--qt').innerHTML = modelsQt;
  }
});

//This code below checks if a specific item is in the cart. If it is not, it add to the array.

c('.modelsInfo--addButton').addEventListener('click', ()=>{
  let identifier = modelsJson[key].id;
  let localId = cart.findIndex((item)=>item.identifier == identifier);
  if(localId > -1){
    if(cart[localId].qt == 1 && modelsQt == 1) {
      cart[localId].qt += modelsQt
    } if(cart[localId].qt == 2) {
      cart[localId].qt = 2;
    };

  } else {
    cart.push({
    identifier,
    id:modelsJson[key].id,
    name:modelsJson[key].name,
    qt:modelsQt,
    price:modelsJson[key].price[0]
  });
  }
  updateCart();
  closeModel();
});


//This function is to update the cart whenever the user does an action.

function updateCart() {
  if(cart.length > 0) {
    c('aside').classList.add('show');
    c('.cart').innerHTML = '';
    let subtotal = 0;
    cart.map((itemCart, index)=>{
      let modelItem = modelsJson.find((itemDB)=>itemDB.id == itemCart.id);
      subtotal += modelItem.price * itemCart.qt;
      let cartItem = c('.models .cart--item').cloneNode(true);
      cartItem.querySelector('img').src = modelItem.img;
      cartItem.querySelector('.cart--item-name').innerHTML = modelItem.name;
      cartItem.querySelector('.cart--item--qt').innerHTML = itemCart.qt;
      cartItem.querySelector('.cart--item--qtless').addEventListener('click', ()=>{
        if(itemCart.qt > 1){
          itemCart.qt--;
        } else {
          cart.splice(index, 1);
        }
        updateCart();
      });
      cartItem.querySelector('.cart--item--qtmore').addEventListener('click', ()=>{
        if(itemCart.qt < 2) {
          itemCart.qt++;
        }
        updateCart();
      });

      c('.cart').append(cartItem);
    });

    let x = subtotal.toFixed(2);
    c('.subtotal span:last-child').innerHTML = `${x}€`;
    localStorage.setItem('subtotal', JSON.stringify(x));
    

  } else {
    c('aside').classList.remove('show');
  }
};

c('.cart--finish').addEventListener('click', ()=>{
  localStorage.setItem('cart', JSON.stringify(cart, ['name', 'qt', 'price']));
  window.location.href = "booking.php";
  return false;
});