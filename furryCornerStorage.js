window.FurryCornerStorage = {

    getProducts(){
        return JSON.parse(
            localStorage.getItem("products")
        ) || [];
    },

    saveProducts(products){
        localStorage.setItem(
            "products",
            JSON.stringify(products)
        );
    },

    getUsers(){
        return JSON.parse(localStorage.getItem("furryCornerUsers")) || [];
    },

    saveUsers(users){
        localStorage.setItem("furryCornerUsers", JSON.stringify(users));
    },

    findUserByEmail(email){
        return this.getUsers().find(user => user.email.toLowerCase() === email.toLowerCase()) || null;
    },

    saveUser(user){
        const users = this.getUsers().filter(u => u.email.toLowerCase() !== user.email.toLowerCase());
        users.push(user);
        this.saveUsers(users);
    },

    emailApiConfig(){
        return {
            serviceId: 'service_3u0l0wg',
            templateId: 'template_o2xsql9',
            publicKey: '7-FhqfLNlf_kEo37c'
        };
    },

    sendVerificationCode(email, code, templateId){
        const config = this.emailApiConfig();
        const finalTemplateId = templateId || config.templateId;
        const placeholders = ['service_abc1234', 'template_xyz5678', 'user_L9876543210abcdef'];
        if (!config.serviceId || !finalTemplateId || !config.publicKey || placeholders.includes(config.serviceId) || placeholders.includes(finalTemplateId) || placeholders.includes(config.publicKey)) {
            throw new Error('EmailJS is not configured. Please update furryCornerStorage.js with your EmailJS service, template, and public key.');
        }

        if (typeof emailjs === 'undefined') {
            throw new Error('EmailJS SDK is not loaded. Add the EmailJS script before your app scripts.');
        }

        if (!emailjs.__initialized) {
            emailjs.init(config.publicKey);
            emailjs.__initialized = true;
        }

        const expiresAt = new Date(Date.now() + 15 * 60 * 1000);
        const formattedTime = expiresAt.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        return emailjs.send(config.serviceId, finalTemplateId, {
            user_email: email,
            email: email,
            to_email: email,
            recipient_email: email,
            to_name: email,
            passcode: code,
            time: formattedTime,
            subject: 'Your FurryCorner verification code'
        }).catch(error => {
            const errorText = error?.text || error?.message || JSON.stringify(error);
            throw new Error(`EmailJS error: ${errorText}`);
        });
    },

    formatPrice(price){
        return "₱" + Number(price).toLocaleString("en-PH", {
            minimumFractionDigits: 2
        });
    },

    getStatusFromStock(stock){

        if(stock <= 0){
            return "Out of Stock";
        }

        if(stock <= 5){
            return "Low Stock";
        }

        return "In Stock";
    }

};