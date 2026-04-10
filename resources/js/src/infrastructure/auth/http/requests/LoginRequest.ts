export class LoginRequest {
    constructor(
        public email: string = '',
        public password: string = '',
        public rememberMe: boolean = false,
        public errors: Record<string, string[]> = {}
    ){}

    public validate(): Record<string, string[]> {
        this.errors = {};

        if(this.email.trim() === ''){
            if(this.errors['email'])
                this.errors['email'].push("Email is required.");
            else
                this.errors['email'] = ["Email is required."];
        }
        if(this.password.trim() === ''){
            if(this.errors['password'])
                this.errors['password'].push("Password is required.");
            else
                this.errors['password'] = ["Password is required."];
        }
        if(!/\S+@\S+\.\S+/.test(this.email)){
            if(this.errors['email'])
                this.errors['email'].push("Invalid email format.");
            else
                this.errors.email = ["Invalid email format."];
        }
        if(this.password.length < 6){
            if(this.errors['password'])
                this.errors['password'].push("Password must be at least 6 characters long.");
            else
                this.errors.password = ["Password must be at least 6 characters long."];
        }

        return this.errors;
    }
}