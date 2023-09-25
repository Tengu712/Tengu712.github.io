using System.Text;
using Ssg.IO;

namespace Ssg.Pages;

/// <summary>
/// [Template Method Pattern]
/// </summary>
public abstract class APage
{
    /// <summary>
    /// A method to generate a HTML file.
    /// </summary>
    public void Generate()
    {
        var dirPath = $"./out{this.getPath()}";
        var filePath = $"{dirPath}index.html";

        if (!Directory.Exists(dirPath))
        {
            Directory.CreateDirectory(dirPath);
        }

        var sw = new StreamWriter(filePath, false, Encoding.UTF8);

        this.output(sw);

        sw.Flush();

        Console.WriteLine($"[ info ] APage.Generate(): generate {filePath}.");
    }

    protected abstract string getPath();
    protected abstract void output(StreamWriter sw);
}
