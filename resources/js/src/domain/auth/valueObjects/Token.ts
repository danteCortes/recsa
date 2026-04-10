export class Token{

    private constructor(private readonly _value: string) {
        this._value = _value;
    }

    public static create(value: string): Token {
        if (!this.isValidToken(value)) {
            throw new Error('Invalid token');
        }
        return new Token(value);
    }

    private static isValidToken(token: string): boolean {
        const tokenParts = token.split('|');
        return tokenParts.length === 2;
    }

    public value(): string {
        return this._value;
    }
}