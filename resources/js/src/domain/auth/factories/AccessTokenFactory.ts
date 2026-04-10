import { AccessToken } from "../entities/AccessToken";
import { ExpireAt } from "../valueObjects/ExpireAt";
import { Token } from "../valueObjects/Token";

export class AccessTokenFactory {

    public static fromPrimitives(token: string, expireAt: Date){

        return AccessToken.create(
            Token.create(token),
            ExpireAt.create(expireAt)
        );
    }
}