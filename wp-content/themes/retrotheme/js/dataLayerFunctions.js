function addProductCart(productObj) {
    dataLayer.push({
        'event': 'productClick',
        'ecommerce': {
            'currencyCode': productObj.currencyCode,
            'click': {
                'actionField': {'list': productObj.list}, 'products': [{
                    'name': productObj.name,
                    'id': productObj.id,
                    'price': productObj.price,
                    'category': productObj.cat,
                    'brand': productObj.brand,
                    'position': productObj.position
                }]
            }
        },
        'eventCallback': function () {
            document.location = productObj.url
        }
    });
}

function addToCartGTM(productObj) {
    dataLayer.push({
        'event': 'addToCart',
        'ecommerce': {
            'currencyCode': productObj.currencyCode,
            'add': {
                'products': [{
                    'name': productObj.name,
                    'id': productObj.id,
                    'price': productObj.price,
                    'category': productObj.cat,
                    'brand': productObj.brand,
                    'quantity': (productObj.quantity) ? productObj.quantity : 1
                }]
            }
        }
    });
}

function removeFromCartGTM(productObj) {
    dataLayer.push({
        'event': 'removeFromCart',
        'ecommerce': {
            'currencyCode': productObj.currencyCode,
            'remove': {
                'products': [{
                    'name': productObj.name,
                    'id': productObj.id,
                    'price': productObj.price,
                    'category': productObj.cat,
                    'brand': productObj.brand,
                    'quantity': productObj.quantity
                }]
            }
        }
    });
}