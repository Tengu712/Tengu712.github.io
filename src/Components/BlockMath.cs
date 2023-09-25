namespace Ssg.Components;

public class BlockMath : IComponent
{
    private readonly string text;

    public BlockMath(string text) => this.text = text;

    public void OutputRequirements(StreamWriter sw)
    {
        sw.WriteLine("<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css' integrity='sha384-GvrOXuhMATgEsSwCs4smul74iXGOixntILdUW9XmUC6+HX0sLNAK3q71HotJqlAn' crossorigin='anonymous'>");
        sw.WriteLine("<script defer src='https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js' integrity='sha384-cpW21h6RZv/phavutF+AuVYrr+dA8xD9zs6FwLpaCct6O9ctzYFfFr4dgmgccOTx' crossorigin='anonymous'></script>");
        sw.WriteLine("<script defer src='https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js' integrity='sha384-+VBxd3r6XgURycqtZ117nYw44OOcIax56Z4dCRWbxyPt0Koah1uHoK0o4+/RRE05' crossorigin='anonymous' onload='renderMathInElement(document.body);'></script>");
    }

    public void Output(StreamWriter sw) => sw.WriteLine($"$${this.text}$$");
}
