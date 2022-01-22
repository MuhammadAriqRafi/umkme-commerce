const mongoose = require('mongoose')

// Entity
const productSchema = new mongoose.Schema({
    // Attributes
    name: {
        type: String,
        required: true
    }
})

module.exports = mongoose.model('Product', productSchema)