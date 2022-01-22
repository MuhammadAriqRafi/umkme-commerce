// ? respond.json() = to send json as respond
// ? respond.status() = to send status in respond

if(process.env.NODE_ENV !== 'production'){
    require('dotenv').config()
}

const express = require('express')
const app = express()
const expressLayouts = require('express-ejs-layouts')
const indexRouter = require('./routes/index')
const productRouter = require('./routes/products')
const bodyParser = require('body-parser')

app.set('view engine', 'ejs')
app.set('views', `${__dirname}/views`)
app.set('layout', 'layouts/layout')
app.use(expressLayouts)
app.use(express.static('public'))
app.use(express.urlencoded({ extended: true }))
app.use(bodyParser.urlencoded({ limit: '10mb', extended: false }))

const mongoose = require('mongoose')
mongoose.connect(process.env.DATABASE_URL, { useNewUrlParser : true })
const db = mongoose.connection
db.on('error', error => console.log(error))
db.once('open', () => console.log('Connect'))

app.use('/', indexRouter)
app.use('/products', productRouter)

app.listen(process.env.PORT || 3000)
