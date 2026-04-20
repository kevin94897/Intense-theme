import { z } from "zod";

const formSchema = z.object({
    firstName: z.string().min(1, "First Name is required").max(100),
    lastName: z.string().min(1, "Last Name is required").max(100),
    email: z.string().min(1, "Email is required").email("Invalid email address"),
    confirmEmail: z.string().min(1, "Confirm Email is required"),
    startDate: z.string().min(1, "Start Date is required"),
    tripLength: z.string().min(1, "Trip Length is required"),
    adults: z.string().min(1, "Adults is required"),
    children: z.string().optional(),
    enfants: z.string().optional(),
    hotelCategory: z.enum(["boutique", "luxury", "superior", "value"], {
        errorMap: () => ({ message: "Please select a Hotel Category" })
    }),
    whatsapp: z.string().optional(),
    hearAboutUs: z.string().optional(),
    mensaje: z.string().optional(),
}).refine((data) => data.email === data.confirmEmail, {
    message: "Emails don't match",
    path: ["confirmEmail"],
});

export default function bookingForm() {
    return {
        formData: {
            firstName: '',
            lastName: '',
            email: '',
            confirmEmail: '',
            startDate: '',
            tripLength: '',
            adults: '2',
            children: '0',
            enfants: '0',
            hotelCategory: '',
            whatsapp: '',
            hearAboutUs: '',
            mensaje: '',
            pageSource: '',
            pageUrl: '',
        },
        errors: {},
        isSubmitting: false,
        submitSuccess: false,

        init() {
            this.formData.pageSource = this.$el.dataset.pageSource || '';
            this.formData.pageUrl    = this.$el.dataset.pageUrl    || window.location.href;
        },

        setHotelCategory(cat) {
            this.formData.hotelCategory = cat;
            if (this.errors.hotelCategory) {
                delete this.errors.hotelCategory;
            }
        },

        validate() {
            try {
                formSchema.parse(this.formData);
                this.errors = {};
                return true;
            } catch (error) {
                if (error instanceof z.ZodError) {
                    const newErrors = {};
                    error.errors.forEach(err => {
                        newErrors[err.path[0]] = err.message;
                    });
                    this.errors = newErrors;
                }
                return false;
            }
        },

        validateField(field) {
            try {
                // To validate a single field, we can parse the whole object and extract
                // the error for the specific field, or just parse the partial schema.
                // It's easier to just do a full validation and update `this.errors`.
                // However, for refine (cross-field), it needs full data.
                formSchema.parse(this.formData);
                this.errors = {};
            } catch (error) {
                if (error instanceof z.ZodError) {
                    const newErrors = { ...this.errors };
                    // Clear the error for this field if it doesn't exist in new validation
                    delete newErrors[field]; 
                    
                    error.errors.forEach(err => {
                        if (err.path[0] === field) {
                            newErrors[field] = err.message;
                        }
                    });
                    this.errors = newErrors;
                }
            }
        },

        async submitForm(e) {
            e.preventDefault();
            this.submitSuccess = false;

            if (!this.validate()) return;

            this.isSubmitting = true;
            try {
                const body = new URLSearchParams({
                    action: 'intense_booking',
                    nonce:  window.intenseAjax?.nonce || '',
                    ...this.formData,
                });
                const res  = await fetch(window.intenseAjax?.ajaxUrl || '/wp-admin/admin-ajax.php', {
                    method: 'POST',
                    body,
                });
                const json = await res.json();
                if (!json.success) throw new Error(json.data?.message || 'Error');

                this.submitSuccess = true;
                window.dispatchEvent(new CustomEvent('ccp:quoteSuccess'));

                setTimeout(() => { this.submitSuccess = false; }, 5000);
            } catch (err) {
                console.error('Booking form error:', err);
            } finally {
                this.isSubmitting = false;
            }
        }
    }
}
