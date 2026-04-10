import { RememberMe } from "../enums/RememberMe";
import { Email } from "../valueObjects/Email";
import { Password } from "../valueObjects/Password";

export class Credentials {

    private constructor(
        private readonly _email: Email,
        private readonly _password: Password,
        private readonly _rememberMe: RememberMe
    ) {
        this._email = _email;
        this._password = _password;
        this._rememberMe = _rememberMe;
    }

    public static create(email: Email, password: Password, rememberMe: RememberMe): Credentials {
        return new Credentials(email, password, rememberMe);
    }

    public email(): Email {
        return this._email;
    }

    public password(): Password {
        return this._password;
    }

    public rememberMe(): boolean {
        return this._rememberMe === RememberMe.YES;
    }
}