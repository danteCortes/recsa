import { Credentials } from "../entities/Credentials";
import { RememberMe } from "../enums/RememberMe";
import { Email } from "../valueObjects/Email";
import { Password } from "../valueObjects/Password";

export class CredentialsFactory {
    
    static fromPrimitives(email: string, password: string, rememberMe: boolean) {
        return Credentials.create(
            Email.create(email),
            Password.create(password),
            rememberMe ? RememberMe.YES : RememberMe.NO
        );
    }
}