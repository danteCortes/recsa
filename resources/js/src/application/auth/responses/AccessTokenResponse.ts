export class AccessTokenResponse {

    private constructor(
        public readonly token: string,
        public readonly expireAt: Date,
    ){}

    public static create(token: string, expireAt: Date): AccessTokenResponse {
        return new AccessTokenResponse(token, expireAt);
    }
}