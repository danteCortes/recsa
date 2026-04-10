import { User } from "../entities/User";
import { Email } from "../valueObjects/Email";
import { Name } from "../valueObjects/Name";
import { UserId } from "../valueObjects/UserId";

export class UserFactory {

    public static fromPrimitives(id: string | null, name: string, email: string) {

        return User.create(
            id ? UserId.create(id) : null,
            Name.create(name),
            Email.create(email)
        );
    }
}