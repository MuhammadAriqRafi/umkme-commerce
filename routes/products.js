const express = require('express');
const { route } = require('express/lib/application');
const product = require('../models/product');
const router = express.Router()
const products = [{name : "Tas Tenteng"}, {name : "Tas Backpack"}, {name : "Pouch"}]
const Product = require('../models/product')

router.use(logger)

// All Products Route
router.get('/', async (req, res) => {
    let searchOption = {}
    if(req.query.name != null && req.query.name !== '') {
        searchOption.name = new RegExp(req.query.name, 'i')
    }

    try { 
        const product = await Product.find(searchOption)
        res.render("products/index", { 
            products : product,
            searchOption: req.query
        })
    } catch {
        res.redirect('/')
    }
});

// Create Product Route
router.get('/create', (req, res) => {
    res.render('products/new', { 
        name : "Product Name",
        product : new Product() 
    })
});

// Store Product Route
router.post('/', async (req, res) => {
    const product = new Product({
        name : req.body.name
    })

    try{
        console.log("Try")
        const newProduct = await product.save()
        // res.redirect(`products/${newProduct.id}`)
        res.redirect('products')
    }catch{
        res.render('products/new', {
            product: product,
            errMessage : "Error Creating Product"
        })
    }

    // product.save((err, newProduct) => {
    //     if(err){
    //         res.render('products/new', {
    //             product: newProduct,
    //             errMessage : 'Error Creating Product'
    //         })
    //     } else {
    //         // res.redirect(`products/${newProduct.id}`)
    //         res.redirect(`products`)
    //     }
    // })
    // const isValid = true
    // if(isValid) {
    //     products.push({name : req.body.name})
    //     res.redirect(`/product/${products.length - 1}`)
    // } else {
    //     console.log("Error");
    //     res.render('newProduct', { name: req.body.name })
    // }
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