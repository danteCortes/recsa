import { AuthRepository } from "@/domain/auth/repositories/AuthRepository";
import { AxiosAuthRepository } from "../implements/AxiosAuthRepository";
import { LoginUseCase } from "@/application/auth/useCases/LoginUseCase";
import { UserUseCase } from "@/application/auth/useCases/UserUseCase";
import { LogoutUseCase } from "@/application/auth/useCases/LogoutUseCase";
import { LoginDTO } from "@/application/auth/dtos/LoginDTO";
import { AccessTokenResponse } from "@/application/auth/responses/AccessTokenResponse";
import { UserResponse } from "@/application/auth/responses/UserResponse";

export class AuthService {

    private repository: AuthRepository = new AxiosAuthRepository;
    private loginUseCase = LoginUseCase.create(this.repository);
    private userUseCase = UserUseCase.create(this.repository);
    private logoutUseCase = LogoutUseCase.create(this.repository);

    public async login(email: string, password: string, rememberMe: boolean): Promise<UserResponse> {
        const response = await this.loginUseCase.execute(new LoginDTO(email, password, rememberMe));
        return response;
    }

    public async user(): Promise<UserResponse | null> {
        const user = await this.userUseCase.execute();
        return user;
    }

    public async logout(): Promise<void> {
        await this.logoutUseCase.execute();
    }
}