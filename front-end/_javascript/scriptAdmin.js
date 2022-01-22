let cart = [];
let key = 0;
let modelsQt = 0;

const c = (el)=>document.querySelector(el);

modelsJson.map((item, index)=>{
  let modelsItem = c('.models .models-item').cloneNode(true);
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
    c('.modelsWindowsArea').style.opacity = 0;
    c('.modelsWindowsArea').style.display = 'flex';
    setTimeout(() => {
      c('.modelsWindowsArea').style.opacity = 1;
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
  if(modelsQt > 1){ //It can't go negative
    modelsQt--;
  c('.modelsInfo--qt').innerHTML = modelsQt;
  }
});

c('.modelsInfo--qtmore').addEventListener('click', ()=>{
  modelsQt++;
  c('.modelsInfo--qt').innerHTML = modelsQt;
  
});

c('.modelsInfo--addButton').addEventListener('click', ()=>{
  let identifier = modelsJson[key].id;
  let localId = cart.findIndex((item)=>item.identifier == identifier);
  if(localId > -1){
    if(cart[localId].qt == 1) {
      cart[localId].qt += modelsQt
    }

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
        itemCart.qt++;
        updateCart();
      });

      c('.cart').append(cartItem);
    });

    c('.subtotal span:last-child').innerHTML = `${subtotal.toFixed(2)}€`;
    

  } else {
    c('aside').classList.remove('show');
  }
};

c('.cart--add').addEventListener('click', ()=>{
  localStorage.setItem('cart', JSON.stringify(cart, ['name', 'qt', 'price']));
  window.location.href = "updateProducts.php";
  return false;
});

c('.cart--remove').addEventListener('click', ()=>{
  localStorage.setItem('cart', JSON.stringify(cart, ['name', 'qt', 'price']));
  window.location.href = "removeProducts.php";
  return false;
});