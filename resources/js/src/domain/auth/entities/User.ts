import { Email } from "../valueObjects/Email";
import { Name } from "../valueObjects/Name";
import { UserId } from "../valueObjects/UserId";

export class User {

    private constructor(
        private readonly _id: UserId | null,
        private readonly _name: Name,
        private readonly _email: Email
    ){
        this._id = _id;
        this._name = _name;
        this._email = _email;
    }

    public static create(id: UserId | null, name: Name, email: Email): User {
        return new User(id, name, email);
    }

    public id(): UserId | null {
        return this._id;
    }

    public name(): Name {
        return this._name;
    }

    public email(): Email {
        return this._email;
    }
}