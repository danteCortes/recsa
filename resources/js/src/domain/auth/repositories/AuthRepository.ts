import { User } from "../entities/User";
import { Credentials } from "../entities/Credentials";

export interface AuthRepository {
    login(credentials: Credentials): Promise<User>;
    logout(): Promise<void>;
    user(): Promise<User | null>;
}