(function(global) {
    const FORM_SYNC_URL = 'http://localhost:8000/store-form-data'; // Define your static URL here
    const DEFAULT_THANK_YOU_MSG = 'Thank you! Your form has been submitted successfully.';

    function FormSync(selector, options) {
        this.forms = document.querySelectorAll(selector);
        this.settings = Object.assign({
            disableOnSubmit: true,
            onSuccess: null,
            onError: null,
            thankYouMsg: DEFAULT_THANK_YOU_MSG
        }, options);

        this.init();
    }

    FormSync.prototype.init = function() {
        var self = this;
        self.forms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                self.submitForm(form);
            });
        });
    };

    FormSync.prototype.submitForm = function(form) {
        var self = this;
        var formData = new FormData(form);

        if (self.settings.disableOnSubmit) {
            self.disableForm(form);
        }

        fetch(FORM_SYNC_URL, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (self.settings.onSuccess) {
                self.settings.onSuccess(data);
            }
            self.clearForm(form);
            alert(self.settings.thankYouMsg);
            self.enableForm(form);
        })
        .catch(error => {
            if (self.settings.onError) {
                self.settings.onError(error);
            }
            self.enableForm(form);
        });
    };

    FormSync.prototype.disableForm = function(form) {
        var inputs = form.querySelectorAll('input, button');
        inputs.forEach(function(input) {
            input.setAttribute('disabled', 'disabled');
        });
    };

    FormSync.prototype.enableForm = function(form) {
        var inputs = form.querySelectorAll('input, button');
        inputs.forEach(function(input) {
            input.removeAttribute('disabled');
        });
    };

    FormSync.prototype.clearForm = function(form) {
        form.reset();
    };

    global.FormSync = function(selector, options) {
        return new FormSync(selector, options);
    };
})(window);
