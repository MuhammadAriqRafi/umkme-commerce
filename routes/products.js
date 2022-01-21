const express = require('express');
const { route } = require('express/lib/application');
const router = express.Router()
const products = [{name : "Tas Tenteng"}, {name : "Tas Backpack"}, {name : "Pouch"}]

router.use(logger)

router.get('/', (req, res) => {
    res.send("Product Page")
});

router.get('/create', (req, res) => {
    res.render('newProduct', { name : "Product Name" })
});

router.post('/', (req, res) => {
    const isValid = true
    if(isValid) {
        products.push({name : req.body.name})
        res.redirect(`/product/${products.length - 1}`)
    } else {
        console.log("Error");
        res.render('newProduct', { name: req.body.name })
    }
});

// ? To group CRUD using route function
router.route("/:id")
    .get((req, res) => {
        console.log(req.user.name)
        res.send(`Get Product ${req.user.name}`)
    }).put((req, res) => {
        res.send(`Update Product ${req.params.id}`)
    }).delete((req, res) => {
        res.send(`Delete Product ${req.params.id}`)
})

router.param("id", (req, res, next, id) => {
    console.log(products[id]);
    if(products[id] !== undefined){
        req.user = products[id]
        next()
    }

    res.send("undefined")
})

function logger(req, res, next){
    console.log(req.originalUrl)
    next()
}

module.exports = router