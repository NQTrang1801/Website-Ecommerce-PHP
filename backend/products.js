const fs = require('fs'); // Import thư viện fs của Node.js
const filePath = 'C:/Users/21521/OneDrive/Tài liệu/DOAN/WEBSITE/Website-Private/backend/products.json';

function readProductsFromFile(callback) {
    fs.readFile(filePath, 'utf8', (err, data) => {
        if (err) {
            console.error('Lỗi khi đọc dữ liệu từ tệp JSON:', err);
            return callback(err, null);
        }

        try {
            const products = JSON.parse(data); // Chuyển đổi dữ liệu từ JSON thành đối tượng JavaScript
            callback(null, products);
        } catch (error) {
            console.error('Lỗi khi phân tích cú pháp dữ liệu JSON:', error);
            callback(error, null);
        }
    });
}

module.exports = {
    readProductsFromFile: readProductsFromFile
};
