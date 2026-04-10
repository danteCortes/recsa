export class ExpireAt {

    private constructor(private readonly _value: Date) {
        this._value = _value;
    }

    public static create(value: Date): ExpireAt {
        if (!this.isValidExpireAt(value)) {
            throw new Error('Invalid expire at date. Expire at date must be in the future.');
        }
        return new ExpireAt(value);
    }

    private static isValidExpireAt(expireAt: Date): boolean {
        const now = new Date();
        return expireAt > now;
    }

    public value(): Date {
        return this._value;
    }
}