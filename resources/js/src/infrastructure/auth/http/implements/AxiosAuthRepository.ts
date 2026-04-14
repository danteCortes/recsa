import { User } from "@/domain/auth/entities/User";
import { Credentials } from "@/domain/auth/entities/Credentials";
import { AuthRepository } from "@/domain/auth/repositories/AuthRepository";
import { Email } from "@/domain/auth/valueObjects/Email";
import { Name } from "@/domain/auth/valueObjects/Name";
import { UserId } from "@/domain/auth/valueObjects/UserId";
import api from "@/infrastructure/http/AxiosSessionInstance";
import { AxiosError } from "axios";

export class AxiosAuthRepository implements AuthRepository {
    
    public async login(credentials: Credentials): Promise<User>{
        try {
            await api.get('/sanctum/csrf-cookie');
            const { data } = await api.post<{id: string; name: string; email: string;}>("/auth/login", {
                email: credentials.email().value(),
                password: credentials.password().value(),
                rememberMe: credentials.rememberMe()
            });

            return User.create(
                UserId.create(data.id),
                Name.create(data.name),
                Email.create(data.email)
            );
        } catch (error: unknown) {
            if(error instanceof AxiosError){
                throw new Error("Login error: " + (error.response?.data?.message || error.message));
            }
            throw new Error("Login error: " + (error instanceof Error ? error.message : String(error)));
        }
    }
    
    public async user(): Promise<User | null>{
        try {
            const { data } = await api.get<{id: string; name: string; email: string;} | null>("/auth/user");

            if(!data) return null;

            return User.create(
                UserId.create(data.id),
                Name.create(data.name),
                Email.create(data.email)
            );
        } catch (error: unknown) {
            if(error instanceof AxiosError){
                throw new Error("Get user error: " + (error.response?.data?.message || error.message));
            }
            throw new Error("Get user error: " + (error instanceof Error ? error.message : String(error)));
        }
    }
    
    public async logout(): Promise<void>{
        try {
            await api.post<void>("/auth/logout");
            
        } catch (error: unknown) {
            if(error instanceof AxiosError){
                throw new Error("Logout error: " + (error.response?.data?.message || error.message));
            }
            throw new Error("Logout error: " + (error instanceof Error ? error.message : String(error)));
        }
    }
}