import { ExpireAt } from "../valueObjects/ExpireAt";
import { Token } from "../valueObjects/Token";

export class AccessToken {

    private constructor(
        private readonly _token: Token,
        private readonly _expireAt: ExpireAt
    ) {
        this._token = _token;
        this._expireAt = _expireAt;
    }

    public static create(token: Token, expireAt: ExpireAt): AccessToken {
        return new AccessToken(token, expireAt);
    }
    
    public token(): Token {
        return this._token;
    }

    public expireAt(): ExpireAt {
        return this._expireAt;
    }

    public isExpired(): boolean {
        const now = new Date();
        return this._expireAt.value() <= now;
    }
}